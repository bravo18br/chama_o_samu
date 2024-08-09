<?php

namespace App\Http\Controllers;

use App\Models\Cartao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartaoController extends Controller
{
    public function restaura(Request $request)
    {
        Cartao::withTrashed()
            ->find($request->id)
            ->restore();
        return redirect()->back()->with(['success' => 'Cartão restaurado com sucesso!']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosRequest = $request->all();
        $validatedData = Validator::make($dadosRequest, [
            'legenda_user' => 'required',
            'legenda_samu' => 'required',
            'foto' => 'required',
            'nivel' => 'required',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['erro' => 'Cartão não criado', 'showModal' => 'createCartaoModal']);
        }

        $foto = $request->file('foto');
        $dadosRequest['imagem_caminho'] = $foto->store('public/images');
        $dadosRequest['imagem_nome'] = $foto->hashName();

        Cartao::create($dadosRequest);
        return redirect()->back()->with(['sucesso' => 'Cartão criado com sucesso!', 'showModal' => 'createCartaoModal']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cartao $cartao)
    {
        $dadosRequest = $request->all();
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $dadosRequest['imagem_caminho'] = $foto->store('public/images');
            $dadosRequest['imagem_nome'] = $foto->hashName();
        }
        $cartao->update($dadosRequest);
        return redirect()->back()->with(['sucesso' => 'Cartão atualizado com sucesso!', 'showModal' => 'editCartaoModal' . $cartao->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cartao $cartao)
    {
        $cartao->delete();
        return redirect()->back()->with(['success' => 'Cartão excluído com sucesso!']);
    }
}
