<?php

use App\Http\Controllers\CartaoController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonitoramentoController;
use App\Http\Controllers\OperacaoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\SamuAdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::view('briefing', 'briefing')
    ->name('briefing');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('superadmin', [SuperAdminController::class, 'retornaSuperAdmin'])
        ->name('superadmin');
    Route::get('dashboard', [DashboardController::class, 'dashboardController'])
        ->name('dashboard');
    Route::get('monitoramento', [MonitoramentoController::class, 'retornaUltimoRegistro'])
        ->name('monitoramento');
    Route::get('historico', [HistoricoController::class, 'retornaHistoricoRegistro'])
        ->name('historico');
    Route::view('profile', 'profile')
        ->name('profile');
    Route::put('chamado', [ChamadoController::class, 'put']);
    Route::resource('chamado', ChamadoController::class);
    Route::get('operacao',  [OperacaoController::class, 'buscaRegistros'])
        ->name('operacao');
    Route::get('samu_admin', [SamuAdminController::class, 'retornaSamuAdmin'])
        ->name('samu_admin');
    Route::put('samu_admin', [SamuAdminController::class, 'atualizaOperador']);
    Route::get('relatorio', [RelatorioController::class, 'retornaRelatorio'])
        ->name('relatorio');
    Route::delete('users', [UserController::class, 'delete']);
    Route::put('users', [UserController::class, 'restaura']);
    Route::resource('cartao', CartaoController::class);
    Route::put('nivel1', [ChamadoController::class, 'put_nivel1']);
    Route::put('nivel2', [ChamadoController::class, 'put_nivel2']);
    Route::put('nivel3', [ChamadoController::class, 'put_nivel3']);
    Route::put('nivel4', [ChamadoController::class, 'put_nivel4']);
});

Route::delete('encerra_visita', [OperacaoController::class, 'visitaDelete']);

Route::get('/service-worker.js', function () {
    $file = public_path('js/service-worker.js');
    $response = Response::make(file_get_contents($file), 200);
    $response->header('Content-Type', 'application/javascript');
    return $response;
});

Route::fallback(function () {
    return view('error404');
});
