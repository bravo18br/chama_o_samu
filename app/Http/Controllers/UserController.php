<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function restaura(Request $request)
    {
        User::withTrashed()
            ->find($request->id)
            ->restore();
        return redirect()->back()->with(['success' => 'Usuário restaurado com sucesso!']);
    }

    public function update(Request $request, User $user)
    {
        $dadosRequest = $request->all();
        $dadosRequest['cpf'] = preg_replace('/\D/', '', $dadosRequest['cpf']);
        $dadosRequest['cep'] = preg_replace('/\D/', '', $dadosRequest['cep']);
        $dadosRequest['celular'] = preg_replace('/\D/', '', $dadosRequest['celular']);

        $validator = Validator::make($dadosRequest, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|integer|in:1,2,3,4',
            'analfabeto' => 'required|integer|in:0,1',
            'password' => 'nullable|string|min:8|confirmed',
            'cpf' => 'required|string|unique:users,cpf,' . $user->id,
            'cep' => 'nullable|string',
            'rua' => 'nullable|string',
            'numero' => 'nullable|string',
            'complemento' => 'nullable|string',
            'celular' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['erro' => 'Usuário não atualizado','showModal' => 'editUserModal'.$user->id]);
        }

        if (empty($dadosRequest['password'])) {
            unset($dadosRequest['password']);
        } else {
            $dadosRequest['password'] = Hash::make($request->password);
        }

        $user->update($dadosRequest);
        return redirect()->back()->with(['sucesso' => 'Usuário atualizado com sucesso!', 'showModal' => 'editUserModal'.$user->id]);
    }

    public function destroy(User $user)
    {
        // Log::channel('integrado')->info('destroy: ' . $user->id);
        $user->delete();
        return redirect()->back()->with(['success' => 'Usuário excluído com sucesso!']);
    }

    public function store(Request $request)
    {
        $dadosRequest = $request->all();
        $dadosRequest['cpf'] = preg_replace('/\D/', '', $dadosRequest['cpf']);
        $dadosRequest['cep'] = preg_replace('/\D/', '', $dadosRequest['cep']);
        $dadosRequest['celular'] = preg_replace('/\D/', '', $dadosRequest['celular']);

        $validatedData = Validator::make($dadosRequest, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'role' => 'required|integer|in:1,2,3,4',
            'analfabeto' => 'required|integer|in:0,1',
            'password' => 'required|string|min:8|confirmed',
            'cpf' => 'required|string|unique:users,cpf',
            'cep' => 'nullable|string',
            'rua' => 'nullable|string',
            'numero' => 'nullable|string',
            'complemento' => 'nullable|string',
            'celular' => 'nullable|string',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['erro' => 'Usuário não criado','showModal' => 'createUserModal']);
        }

        $validatedData = $validatedData->validated();
        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);

        return redirect()->back()->with(['sucesso' => 'Usuário criado com sucesso!', 'showModal' => 'createUserModal']);
    }
}
