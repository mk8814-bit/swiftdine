<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
});

Route::get('/menu/{category}', [MenuController::class, 'show'])->name('menu.show');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'loginProcess'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'registerProcess'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard (all authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Superadmin only
    Route::middleware(['role:superadmin'])->prefix('superadmin')->name('dashboard.')->group(function () {

        // New Features
        Route::resource('salaries', \App\Http\Controllers\Superadmin\SalaryController::class);
        Route::resource('inventories', \App\Http\Controllers\Superadmin\InventoryController::class);
        Route::resource('operational-costs', \App\Http\Controllers\Superadmin\OperationalCostController::class);
        Route::resource('addons', \App\Http\Controllers\Superadmin\AddonController::class);


        // Settings
        Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
        Route::post('/settings', [DashboardController::class, 'settingsUpdate'])->name('settings.update');
    });

    // Admin & Superadmin Features
    Route::middleware(['role:superadmin,admin'])->name('dashboard.')->group(function () {
        // Users
        Route::get('/users', [DashboardController::class, 'users'])->name('users');
        Route::get('/users/{user}/edit', [DashboardController::class, 'userEdit'])->name('users.edit');
        Route::put('/users/{user}', [DashboardController::class, 'userUpdate'])->name('users.update');

        // Menu CRUD
        Route::get('/menus', [DashboardController::class, 'menus'])->name('menus');
        Route::get('/menus/create', [DashboardController::class, 'menuCreate'])->name('menus.create');
        Route::post('/menus', [DashboardController::class, 'menuStore'])->name('menus.store');
        Route::get('/menus/{menu}/edit', [DashboardController::class, 'menuEdit'])->name('menus.edit');
        Route::put('/menus/{menu}', [DashboardController::class, 'menuUpdate'])->name('menus.update');
        Route::delete('/menus/{menu}', [DashboardController::class, 'menuDestroy'])->name('menus.destroy');
        Route::post('/menus/{menu}/toggle', [DashboardController::class, 'menuToggle'])->name('menus.toggle');

        Route::resource('packages', \App\Http\Controllers\Superadmin\PackageController::class);

        // Reports
        Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports');

        // Meja & Barcode
        Route::resource('meja', \App\Http\Controllers\MejaController::class);
        Route::get('/barcode', [DashboardController::class, 'barcode'])->name('barcode');
    });

    // Kasir only
    Route::middleware(['role:kasir'])->prefix('kasir')->name('dashboard.kasir.')->group(function () {
        Route::get('/scan', [\App\Http\Controllers\KasirController::class, 'scan'])->name('scan');
    });

    // Waiter only
    Route::middleware(['role:waiter'])->prefix('waiter')->name('dashboard.waiter.')->group(function () {
        Route::get('/orders', [\App\Http\Controllers\WaiterController::class, 'orders'])->name('orders');
    });

    // Owner only
    Route::middleware(['role:owner'])->prefix('owner')->name('dashboard.owner.')->group(function () {
        Route::get('/reports/finance', [\App\Http\Controllers\ReportController::class, 'finance'])->name('reports.finance');
        Route::get('/reports/monthly', [\App\Http\Controllers\ReportController::class, 'monthly'])->name('reports.monthly');
    });

    // Pelanggan only
    Route::middleware(['role:pelanggan'])->name('dashboard.pelanggan.')->group(function () {
        Route::get('/cart', [\App\Http\Controllers\OrderController::class, 'cart'])->name('cart');
        Route::post('/cart/add/{menu}', [\App\Http\Controllers\OrderController::class, 'addToCart'])->name('cart.add');
        Route::put('/cart/update/{item}', [\App\Http\Controllers\OrderController::class, 'updateCart'])->name('cart.update');
        Route::delete('/cart/remove/{item}', [\App\Http\Controllers\OrderController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/cart/checkout', [\App\Http\Controllers\OrderController::class, 'checkout'])->name('cart.checkout');
        Route::get('/cart/success', [\App\Http\Controllers\OrderController::class, 'success'])->name('cart.success');

        Route::get('/orders/history', [\App\Http\Controllers\OrderController::class, 'history'])->name('history');
    });
});
