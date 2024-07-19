<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\Visita;
use Illuminate\Http\Request;

class OperacaoController extends Controller
{
    public function buscaRegistros(Request $request)
    {
        $visita = Visita::create([
            'user_id' => auth()->id(),
            'rota' => $request->path()
        ]);
        $cancelados_lista = [];
        $abertos_lista = [];
        $em_andamento_lista = [];
        $encerrados_lista = [];
        $outros_lista = [];

        $chamados = Chamado::with('foto', 'user')
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

        return view('operacao', [
            'outros_lista' => $outros_lista,
            'encerrados_lista' => $encerrados_lista,
            'em_andamento_lista' => $em_andamento_lista,
            'abertos_lista' => $abertos_lista,
            'cancelados_lista' => $cancelados_lista,
            'visita_id' => $visita->id
        ]);
    }
    public function visitaDelete(Request $request)
    {
        $id = $request->id;
        Visita::find($id)->delete();
    }
}