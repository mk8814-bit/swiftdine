<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Menu;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'superadmin':
                return $this->superadminDashboard();
            case 'admin':
                return $this->adminDashboard();
            case 'waiter':
                return $this->waiterDashboard();
            case 'kasir':
                return $this->kasirDashboard();
            default:
                return $this->pelangganDashboard();
        }
    }

    private function superadminDashboard()
    {
        $totalUsers    = User::count();
        $activeUsers   = User::where('role', '!=', 'pelanggan')->count();
        $totalMenus    = Menu::count();
        $hiddenMenus   = Menu::where('is_active', false)->count();
        $siteName      = Setting::where('key', 'site_name')->value('value') ?? 'SwiftDine';
        $location      = Setting::where('key', 'location')->value('value') ?? '-';

        $usersByRole = User::selectRaw('role, count(*) as total')
            ->groupBy('role')
            ->get();

        return view('dashboard.superadmin', compact(
            'totalUsers', 'activeUsers', 'totalMenus', 'hiddenMenus',
            'siteName', 'location', 'usersByRole'
        ));
    }

    private function adminDashboard()
    {
        $totalMenus  = Menu::count();
        $activeMenus = Menu::where('is_active', true)->count();
        $totalUsers  = User::where('role', 'pelanggan')->count();

        return view('dashboard.admin', compact('totalMenus', 'activeMenus', 'totalUsers'));
    }

    private function waiterDashboard()
    {
        $dummyTables = [
            ['number' => 1,  'status' => 'occupied', 'guest' => 'Agus Pratama',  'since' => '13:00'],
            ['number' => 2,  'status' => 'empty',    'guest' => null,            'since' => null],
            ['number' => 3,  'status' => 'occupied', 'guest' => 'Budi Santoso',  'since' => '12:30'],
            ['number' => 4,  'status' => 'empty',    'guest' => null,            'since' => null],
            ['number' => 5,  'status' => 'empty',    'guest' => null,            'since' => null],
            ['number' => 6,  'status' => 'empty',    'guest' => null,            'since' => null],
            ['number' => 7,  'status' => 'occupied', 'guest' => 'Siti Aminah',   'since' => '12:45'],
            ['number' => 8,  'status' => 'empty',    'guest' => null,            'since' => null],
            ['number' => 9,  'status' => 'empty',    'guest' => null,            'since' => null],
            ['number' => 10, 'status' => 'occupied', 'guest' => 'Dinda Putri',   'since' => '13:15'],
            ['number' => 11, 'status' => 'empty',    'guest' => null,            'since' => null],
            ['number' => 12, 'status' => 'empty',    'guest' => null,            'since' => null],
        ];
        return view('dashboard.waiter', compact('dummyTables'));
    }

    private function kasirDashboard()
    {
        $activeMenus  = Menu::where('is_active', true)->count();
        $totalMembers = User::where('role', 'pelanggan')->count();
        return view('dashboard.kasir', compact('activeMenus', 'totalMembers'));
    }

    private function pelangganDashboard()
    {
        $menus = Menu::where('is_active', true)->get()->groupBy('category');
        return view('dashboard.pelanggan', compact('menus'));
    }

    // ─── Superadmin: Menu CRUD ───────────────────────────────────────────────

    public function menus()
    {
        $menus = Menu::orderBy('category')->paginate(10);
        return view('dashboard.superadmin.menus', compact('menus'));
    }

    public function menuCreate()
    {
        return view('dashboard.superadmin.menu-form');
    }

    public function menuStore(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        Menu::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
            'is_active'   => true,
        ]);
        return redirect()->route('dashboard.menus')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function menuEdit(Menu $menu)
    {
        return view('dashboard.superadmin.menu-form', compact('menu'));
    }

    public function menuUpdate(Request $request, Menu $menu)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = $menu->image;
        if ($request->hasFile('image')) {
            if ($menu->image && (strpos($menu->image, '/') !== false || strpos($menu->image, '.') !== false)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($menu->image);
            }
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        $menu->update([
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
        ]);

        return redirect()->route('dashboard.menus')->with('success', 'Menu berhasil diperbarui!');
    }

    public function menuDestroy(Menu $menu)
    {
        if ($menu->image && (strpos($menu->image, '/') !== false || strpos($menu->image, '.') !== false)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($menu->image);
        }
        $menu->delete();
        return redirect()->route('dashboard.menus')->with('success', 'Menu berhasil dihapus!');
    }

    public function menuToggle(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);
        return redirect()->back()->with('success', 'Status menu diperbarui!');
    }

    // ─── Superadmin: Settings ────────────────────────────────────────────────

    public function settings()
    {
        $settings = Setting::all()->keyBy('key');
        return view('dashboard.superadmin.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        $keys = ['site_name', 'location', 'tagline', 'spesial_hari_ini'];
        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $request->$key]);
            }
        }
        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    // ─── Superadmin: Users ───────────────────────────────────────────────────

    public function users()
    {
        $users = User::orderBy('role')->paginate(15);
        return view('dashboard.superadmin.users', compact('users'));
    }

    public function userEdit(User $user)
    {
        return view('dashboard.superadmin.user-form', compact('user'));
    }

    public function userUpdate(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:superadmin,admin,waiter,kasir,pelanggan',
        ]);

        $user->update($request->only(['name', 'email', 'role']));

        return redirect()->route('dashboard.users')->with('success', 'Akun pengguna berhasil diperbarui!');
    }

    // ─── Superadmin: Barcode Generator ───────────────────────────────────────

    public function barcode()
    {
        $baseUrl = config('app.url');
        return view('dashboard.superadmin.barcode', compact('baseUrl'));
    }
}
