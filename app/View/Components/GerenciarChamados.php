<?php

namespace App\View\Components;

use App\Models\Chamado;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GerenciarChamados extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        try {
            $chamados_lista = Chamado::withTrashed()->get();
            $listas = [
                'chamados' => $chamados_lista
            ];
            return view('components.gerenciar-chamados', [
                'listas' => $listas
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
