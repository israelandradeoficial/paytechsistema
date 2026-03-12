<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\TaxaController;
use App\Http\Controllers\Admin\MaquininhaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SimulatorController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/termos-de-uso', function () {
    return view('legal.terms');
})->name('legal.terms');

Route::get('/politica-de-privacidade', function () {
    return view('legal.privacy');
})->name('legal.privacy');

Route::get('/simulador', [SimulatorController::class, 'index'])->name('simulator.index');
Route::post('/simulador', [SimulatorController::class, 'access'])->name('simulator.access');
Route::get('/simulador/sair', [SimulatorController::class, 'logout'])->name('simulator.logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Clientes
    Route::middleware('can:manage_clients')->group(function () {
        Route::resource('admin/clientes', ClienteController::class)->names('admin.clientes');
        Route::get('admin/clientes/{cliente}/taxas', [TaxaController::class, 'index'])->name('admin.clientes.taxas.index');
        Route::get('admin/clientes/{cliente}/pdf', [ClienteController::class, 'pdf'])->name('admin.clientes.pdf');

        // Maquininhas
        Route::get('admin/clientes/{cliente}/maquininhas', [MaquininhaController::class, 'index'])->name('admin.clientes.maquininhas.index');
        Route::post('admin/clientes/{cliente}/maquininhas', [MaquininhaController::class, 'store'])->name('admin.clientes.maquininhas.store');
        Route::put('admin/maquininhas/{maquininha}', [MaquininhaController::class, 'update'])->name('admin.maquininhas.update');
        Route::delete('admin/maquininhas/{maquininha}', [MaquininhaController::class, 'destroy'])->name('admin.maquininhas.destroy');
    });

    // Usuários (Apenas quem tem permissão manage_users)
    Route::middleware('can:manage_users')->group(function () {
        Route::resource('admin/users', UserController::class)->names('admin.users');
    });

    // Taxas & Simulador (manage_rates)
    Route::middleware('can:manage_rates')->group(function () {
        Route::post('admin/clientes/{cliente}/taxas', [TaxaController::class, 'store'])->name('admin.clientes.taxas.store');
        Route::post('admin/clientes/{cliente}/taxas/single', [TaxaController::class, 'storeSingle'])->name('admin.taxas.storeSingle');
        Route::put('admin/taxas/bulk', [TaxaController::class, 'updateMany'])->name('admin.taxas.updateMany');
        Route::put('admin/taxas/{taxa}', [TaxaController::class, 'update'])->name('admin.taxas.update');
        Route::delete('admin/taxas/{taxa}', [TaxaController::class, 'destroy'])->name('admin.taxas.destroy');
    });

    // Configurações (Apenas Administradores)
    Route::prefix('admin')->middleware('can:manage_users')->group(function () { // Using manage_users as proxy for admin or I should check role
        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');

        // Personalização do Site
        Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('admin.site_settings.index');
        Route::post('/site-settings', [SiteSettingController::class, 'update'])->name('admin.site_settings.update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
