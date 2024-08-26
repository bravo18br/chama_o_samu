<?php

namespace App\Http\Controllers;

use App\Models\Cartao;
use App\Models\Chamado;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\Request;
use Tigo\DocumentBr\Cpf;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function retornaSuperAdmin()
    {
        try {
            $users_lista = User::withTrashed()->get();
            // $chamados_lista = Chamado::withTrashed()->get();
            // $fotos_lista = Foto::all();
            // $cartoes_lista = Cartao::withTrashed()->get();
            $listas = [
                'users' => $users_lista,
                // 'chamados' => $chamados_lista,
                // 'fotos' => $fotos_lista,
                // 'cartoes' => $cartoes_lista
            ];
            return view('superadmin', [
                'listas' => $listas
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
