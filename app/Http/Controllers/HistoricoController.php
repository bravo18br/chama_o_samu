<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chamado;

class HistoricoController extends Controller
{
    public function retornaHistoricoRegistro()
    {
        $cancelados_lista = [];
        $abertos_lista = [];
        $em_andamento_lista = [];
        $encerrados_lista = [];
        $outros_lista = [];

        $idUsuario = Auth::id();
        $chamados = Chamado::with('foto', 'user')
            ->where('user_id', $idUsuario)
            ->orderBy('id', 'desc')
            ->get();

        foreach ($chamados as $chamado) {
            switch ($chamado->situacao) {
                case 4:
                    $cancelados_lista[] = $chamado;
                    break;
                case 1:
                    $abertos_lista[] = $chamado;
                    break;
                case 2:
                    $em_andamento_lista[] = $chamado;
                    break;
                case 3:
                    $encerrados_lista[] = $chamado;
                    break;
                default:
                    $outros_lista[] = $chamado;
            }
        }

        return view('usuario.historico', [
            'outros_lista' => $outros_lista,
            'encerrados_lista' => $encerrados_lista,
            'em_andamento_lista' => $em_andamento_lista,
            'abertos_lista' => $abertos_lista,
            'cancelados_lista' => $cancelados_lista
        ]);

    }
}
