<?php

namespace App\View\Components;

use App\Models\Cartao;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GerenciarCartoes extends Component
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
            $cartoes_lista = Cartao::withTrashed()->get();
            $listas = [
                'cartoes' => $cartoes_lista
            ];
            return view('components.gerenciar-cartoes', [
                'listas' => $listas
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
