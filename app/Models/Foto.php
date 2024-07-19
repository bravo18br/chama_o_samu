<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $fillable = [
        'chamado_id',
        'nome',
        'caminho'
    ];
    public function chamado()
    {
        return $this->belongsTo(Chamado::class);
    }
}
