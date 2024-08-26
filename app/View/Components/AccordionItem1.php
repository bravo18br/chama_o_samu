<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AccordionItem1 extends Component
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
        $users_lista = User::withTrashed()->get();
        $listas = [
            'users' => $users_lista,
        ];
        return view('components.accordion-item1', [
            'listas' => $listas
        ]);
    }
}


