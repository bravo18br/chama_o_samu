<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MonitoramentoController extends Controller
{
    public function retornaUltimoRegistro()
    {
        $idUsuario = Auth::id();
        $chamadoMaisRecente = Chamado::with('foto', 'user','cartao')
            ->where('user_id', $idUsuario)
            ->whereIn('situacao', [1, 2])
            ->orderBy('id', 'desc')
            ->first();
        return view('usuario.monitoramento', ['chamado' => $chamadoMaisRecente]);
    }
}
