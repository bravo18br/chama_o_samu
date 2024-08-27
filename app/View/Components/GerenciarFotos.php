<?php

namespace App\View\Components;

use App\Models\Foto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GerenciarFotos extends Component
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
            $fotos_lista = Foto::withTrashed()->get();
            $listas = [
                'fotos' => $fotos_lista
            ];
            return view('components.gerenciar-fotos', [
                'listas' => $listas
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
