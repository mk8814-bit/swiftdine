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
            case 'owner':
                return $this->ownerDashboard();
            case 'koki':
                return $this->kitchenDashboard('koki');
            case 'barista':
                return $this->kitchenDashboard('barista');
            case 'staf_gudang':
                return $this->warehouseDashboard();
            default:
                return $this->pelangganDashboard();
        }
    }

    private function warehouseDashboard()
    {
        // Dummy data for warehouse
        $lowStockItems = [
            (object) ['name' => 'Beras Premium', 'current_stock' => 10, 'unit' => 'Kg', 'min_stock' => 50],
            (object) ['name' => 'Gula Pasir', 'current_stock' => 5, 'unit' => 'Kg', 'min_stock' => 20],
            (object) ['name' => 'Minyak Goreng', 'current_stock' => 8, 'unit' => 'Liter', 'min_stock' => 30],
        ];

        return view('dashboard.warehouse', compact('lowStockItems'));
    }

    private function kitchenDashboard($role)
    {
        // Dummy data for pending orders logic
        // In real app, we would query order items filtering by menu category (Makanan for Koki, Minuman for Barista)
        $pendingItems = [
            (object) ['id' => 1, 'menu_name' => 'Nasi Goreng Spesial', 'qty' => 2, 'table' => 'Meja 04', 'time' => '10 min ago'],
            (object) ['id' => 2, 'menu_name' => 'Ayam Bakar Madu', 'qty' => 1, 'table' => 'Meja 02', 'time' => '5 min ago'],
        ];

        if ($role === 'barista') {
            $pendingItems = [
                (object) ['id' => 3, 'menu_name' => 'Kopi Gula Aren', 'qty' => 2, 'table' => 'Meja 04', 'time' => '8 min ago'],
                (object) ['id' => 4, 'menu_name' => 'Es Teh Lemon', 'qty' => 3, 'table' => 'Meja 01', 'time' => '2 min ago'],
            ];
        }

        return view('dashboard.kitchen', compact('role', 'pendingItems'));
    }

    private function ownerDashboard()
    {
        // Owner typically sees high-level statistics like total revenue, etc.
        $totalRevenue = 15000000; // Dummy value
        $activeEmployees = User::whereIn('role', ['admin', 'waiter', 'kasir', 'barista', 'koki', 'staf_gudang'])->count();
        $totalMenus = Menu::count();

        return view('dashboard.owner', compact('totalRevenue', 'activeEmployees', 'totalMenus'));
    }

    private function superadminDashboard()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('role', '!=', 'pelanggan')->count();
        $totalMenus = Menu::count();
        $hiddenMenus = Menu::where('is_active', false)->count();
        $siteName = Setting::where('key', 'site_name')->value('value') ?? 'SwiftDine';
        $location = Setting::where('key', 'location')->value('value') ?? '-';

        $usersByRole = User::selectRaw('role, count(*) as total')
            ->groupBy('role')
            ->get();

        return view('dashboard.superadmin', compact(
            'totalUsers',
            'activeUsers',
            'totalMenus',
            'hiddenMenus',
            'siteName',
            'location',
            'usersByRole'
        ));
    }

    private function adminDashboard()
    {
        $totalMenus = Menu::count();
        $activeMenus = Menu::where('is_active', true)->count();
        $totalUsers = User::where('role', 'pelanggan')->count();

        return view('dashboard.admin', compact('totalMenus', 'activeMenus', 'totalUsers'));
    }

    private function waiterDashboard()
    {
        $tables = \App\Models\Meja::orderBy('number')->get();
        return view('dashboard.waiter', compact('tables'));
    }

    private function kasirDashboard()
    {
        $activeMenus = Menu::where('is_active', true)->count();
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
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        Menu::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'is_active' => true,
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
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = $menu->image;
        if ($request->hasFile('image')) {
            if ($menu->image && (strpos($menu->image, '/') !== false || strpos($menu->image, '.') !== false)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($menu->image);
            }
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        $menu->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
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

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $path]);
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:superadmin,admin,waiter,kasir,pelanggan,barista,koki,staf_gudang,owner',
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
