<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cartao extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nivel',
        'legenda_user',
        'legenda_samu',
        'imagem_nome',
        'imagem_caminho'
    ];
    public function chamados()
    {
        return $this->belongsToMany(Chamado::class);
    }
}
