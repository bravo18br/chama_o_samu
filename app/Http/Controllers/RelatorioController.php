<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chamado;
use App\Models\User;

class RelatorioController extends Controller
{
    public function retornaRelatorio()
    {
        [,, $totalUsuarios] = $this->usuariosTipo();
        [$grafico_tempo_chamado, $tempoMedioChamado] = $this->graficoTempoChamado();
        return view('relatorio')->with([
            'grafico_chamados_mes' => $this->graficoChamadosMes(),
            'total_chamados_mes' => $this->chamadosMes()->count(),
            'total_operadores' => $this->operadoresMes()->count(),
            'grafico_operadores' => $this->graficoOperadores(),
            'grafico_usuarios' => $this->graficoUsuarioTipo(),
            'total_usuarios' => $totalUsuarios,
            'tempo_medio_chamado' => $tempoMedioChamado,
            'grafico_tempo_chamado' => $grafico_tempo_chamado
        ]);
    }
    private function corAleatoria()
    {
        $corAleatoria = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        return $corAleatoria;
    }
    private function usuariosTipo()
    {
        $usuariosAnalf = User::where('role', 3)
            ->where('analfabeto', 1)
            ->count();

        $usuariosAlfa = User::where('role', 3)
            ->where('analfabeto', 0)
            ->count();

        $total = $usuariosAnalf + $usuariosAlfa;
        return [$usuariosAnalf, $usuariosAlfa, $total];
    }
    private function graficoUsuarioTipo()
    {
        [$usuariosAnalf, $usuariosAlfa,] = $this->usuariosTipo();

        $cor1 = $this->corAleatoria();
        $cor2 = $this->corAleatoria();
        return $graficoUsuariosTipo = [
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Alfabetizados', 'Analfabetos'],
                'datasets' => [
                    [
                        'label' => 'Usuários',
                        'data' => [$usuariosAlfa, $usuariosAnalf],
                        'backgroundColor' => [$cor1, $cor2],
                        'hoverOffset' => 4
                    ]
                ]
            ],
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'right'],
                    'title' => ['display' => true, 'text' => 'Usuários por Tipo']
                ]
            ]
        ];
    }
    private function chamadosMes()
    {
        $inicioMes = date('Y-m-01');
        $fimMes = date('Y-m-t');
        return Chamado::whereDate('created_at', '>=', $inicioMes)
            ->whereDate('created_at', '<=', $fimMes);
    }
    private function graficoChamadosMes()
    {
        $chamadosMes = $this->chamadosMes()->count();
        $chamadosAbertos = $this->chamadosMes()->where('situacao', '1')->count();
        $chamadosEmAndamento = $this->chamadosMes()->where('situacao', '2')->count();
        $chamadosEncerrados = $this->chamadosMes()->where('situacao', '3')->count();
        $chamadosCancelados = $chamadosMes - $chamadosAbertos - $chamadosEmAndamento - $chamadosEncerrados;

        return $graficoChamadosMes = [
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Abertos', 'Em andamento', 'Encerrados', 'Cancelados'],
                'datasets' => [
                    [
                        'label' => 'Chamados',
                        'data' => [$chamadosAbertos, $chamadosEmAndamento, $chamadosEncerrados, $chamadosCancelados],
                        'backgroundColor' => ['red', 'yellow', 'green', 'gray'],
                        'hoverOffset' => 4
                    ]
                ]
            ],
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'right'],
                    'title' => ['display' => true, 'text' => 'Chamados por Situação']
                ]
            ]
        ];
    }
    private function operadoresMes()
    {
        $inicioMes = date('Y-m-01');
        $fimMes = date('Y-m-t');
        return $operadores = User::with(['visitas' => function ($query) use ($inicioMes, $fimMes) {
            $query->withTrashed()
                  ->whereDate('created_at', '>=', $inicioMes)
                  ->whereDate('created_at', '<=', $fimMes);
        }])
        ->where('role', 2)
        ->get();
    }
    
    private function graficoOperadores()
    {
        $operadores = $this->operadoresMes();
        $labels = [];
        $tempo = [];
        $backgroundColor = [];
        foreach ($operadores as $operador) {
            array_push($labels, $operador->name);
            $contadorTempo = 0;
            foreach ($operador->visitas as $visita) {
                $inicio = $visita->created_at;
                $fim = $visita->deleted_at ? $visita->deleted_at : $visita->created_at;
                $tempoVisita = $inicio->diffInMinutes($fim);
                $contadorTempo += $tempoVisita;
            }
            array_push($tempo, $contadorTempo);
            $cor = $this->corAleatoria();
            array_push($backgroundColor, $cor);
        }

        return [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Em minutos',
                        'data' => $tempo,
                        'backgroundColor' => $backgroundColor,
                        'hoverOffset' => 4
                    ]
                ]
            ],
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => [
                        'display' => false,
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Tempos por Operador (em minutos)'
                    ]
                ]
            ]
        ];
    }
    private function graficoTempoChamado()
    {
        $chamadosEncerrados = $this->chamadosMes()->where('situacao', 3)->get();
        $totalChamados = $this->chamadosMes()->count();
        $totalTempo = 0;
        $labels = [];
        $tempo = [];
        $backgroundColor = [];

        foreach ($chamadosEncerrados as $chamado) {
            array_push($labels, 'ID: ' . $chamado->id);
            $inicio = $chamado->created_at;
            $fim = $chamado->updated_at ? $chamado->updated_at : $chamado->created_at;
            $tempoVisita = $inicio->diffInMinutes($fim);
            array_push($tempo, ($tempoVisita));
            $totalTempo += $tempoVisita;
            $cor = $this->corAleatoria();
            array_push($backgroundColor, $cor);
        }

        if (!$totalChamados == 0) {
            $tempoMedia = $totalTempo / $totalChamados;
        } else {
            $tempoMedia = 0;
        }

        $graficoTempoChamado = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Minutos',
                        'data' => $tempo,
                        'backgroundColor' => $backgroundColor,
                        'hoverOffset' => 4
                    ]
                ]
            ],
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => [
                        'display' => false,
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Tempo de Atendimento por Chamado (em minutos)'
                    ]
                ]
            ]
        ];
        return [$graficoTempoChamado, $tempoMedia];
    }
}
