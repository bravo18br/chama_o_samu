<?php

namespace App\Http\Controllers;

use App\Models\Cartao;
use Illuminate\Http\Request;

class CartaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'legenda_user' => 'required',
            'legenda_samu' => 'required',
            'foto' => 'required',
            'nivel' => 'required',
        ]);
        $dadosRequest = $request->all();
        $foto = $request->file('foto');
        $dadosRequest['imagem_caminho'] = $foto->store('public/imagens');
        $dadosRequest['imagem_nome'] = $foto->hashName();

        Cartao::create($dadosRequest);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cartao $cartao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cartao $cartao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cartao $cartao)
    {
        $dadosRequest = $request->all();
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $dadosRequest['imagem_caminho'] = $foto->store('public/imagens');
            $dadosRequest['imagem_nome'] = $foto->hashName();
        }
        $cartao->update($dadosRequest);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cartao $cartao)
    {
        $cartao->delete();
        return back();
    }
}