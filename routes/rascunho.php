<?php

use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\MonitoramentoController;
use App\Http\Controllers\OperacaoController;
use App\Http\Controllers\SamuAdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')
    ->name('home');

Route::get('dashboard', [DashboardController::class, 'dashboardController'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('operacao',  [OperacaoController::class, 'buscaRegistros'])
    ->middleware(['auth', 'verified'])
    ->name('operacao');

Route::get('monitoramento', [MonitoramentoController::class, 'retornaUltimoRegistro'])
    ->middleware(['auth'])
    ->name('monitoramento');

Route::get('historico', [HistoricoController::class, 'retornaHistoricoRegistro'])
    ->middleware(['auth'])
    ->name('historico');

Route::get('samu_admin', [SamuAdminController::class, 'retornaSamuAdmin'])
    ->middleware(['auth'])
    ->name('samu_admin');

Route::put('samu_admin', [SamuAdminController::class, 'atualizaOperador'])
    ->middleware(['auth']);

require __DIR__ . '/auth.php';

Route::put('chamado', [ChamadoController::class, 'put']);

Route::resource('chamado', ChamadoController::class);

Route::view('relatorio', 'relatorio')
    ->name('relatorio');

Route::get('superadmin', [SuperAdminController::class, 'retornaSuperAdmin'])
    ->middleware(['auth'])
    ->name('superadmin');

Route::delete('users', [UserController::class, 'delete']);
Route::put('users', [UserController::class, 'restaura']);
