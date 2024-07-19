<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tigo\DocumentBr\Cpf;
use Illuminate\Support\Facades\Validator;

class SamuAdminController extends Controller
{
    public function retornaSamuAdmin()
    {
        $operadores_lista = [];
        $operadores_lista = User::where('role', 2)
            ->orderBy('name', 'asc')
            ->get();

        return view('samuAdm', [
            'operadores_lista' => $operadores_lista
        ]);
    }

    public function atualizaOperador(Request $request)
    {
        if ($request->cpf) {
            $cpf = new Cpf();
            if (!$cpf->check($request->cpf)) {
                return back()->withErrors(['cpf' => 'CPF incorreto']);
            };

            $user = User::where('cpf', $request->cpf)
                ->first();
            if ($user) {
                if ($user->role == 3) {
                    $user->role = 2;
                    $user->save();
                    return $this->retornaSamuAdmin();
                } else {
                    return back()->withErrors(['cpf' => 'Usuário não possui permissão para atualizar']);
                }
            } else {
                return back()->withErrors(['cpf' => 'CPF não encontrado']);
            }
        }
        if ($request->email) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return back()->withErrors(['email' => 'Email incorreto']);
            } else {
                $user = User::where('email', $request->email)
                    ->first();
                if ($user) {
                    switch ($user->role) {
                        case 3:
                            $user->role = 2;
                            break;
                        case 2:
                            $user->role = 3;
                            break;
                        default:
                            return back()->withErrors(['email' => 'Usuário não possui permissão para atualizar']);
                    }
                    $user->save();
                    return $this->retornaSamuAdmin();
                } else {
                    return back()->withErrors(['email' => 'Email não encontrado']);
                }
            }
        }
    }
}
