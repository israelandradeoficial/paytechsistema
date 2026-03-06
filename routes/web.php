<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\TaxaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SimulatorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/simulador', [SimulatorController::class, 'index'])->name('simulator.index');
Route::post('/simulador', [SimulatorController::class, 'access'])->name('simulator.access');
Route::get('/simulador/sair', [SimulatorController::class, 'logout'])->name('simulator.logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Clientes
    Route::middleware('can:manage_clients')->group(function () {
        Route::resource('admin/clientes', ClienteController::class)->names('admin.clientes');
        Route::get('admin/clientes/{cliente}/taxas', [TaxaController::class, 'index'])->name('admin.clientes.taxas.index');
    });

    // Usuários (Apenas quem tem permissão manage_users)
    Route::middleware('can:manage_users')->group(function () {
        Route::resource('admin/users', UserController::class)->names('admin.users');
    });

    // Taxas & Simulador (manage_rates)
    Route::middleware('can:manage_rates')->group(function () {
        Route::post('admin/clientes/{cliente}/taxas', [TaxaController::class, 'store'])->name('admin.clientes.taxas.store');
        Route::post('admin/clientes/{cliente}/taxas/single', [TaxaController::class, 'storeSingle'])->name('admin.taxas.storeSingle');
        Route::put('admin/taxas/{taxa}', [TaxaController::class, 'update'])->name('admin.taxas.update');
        Route::delete('admin/taxas/{taxa}', [TaxaController::class, 'destroy'])->name('admin.taxas.destroy');
        Route::put('admin/taxas/bulk', [TaxaController::class, 'updateMany'])->name('admin.taxas.updateMany');
    });

    // Configurações (Apenas Administradores)
    Route::prefix('admin')->middleware('can:manage_users')->group(function () { // Using manage_users as proxy for admin or I should check role
        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
