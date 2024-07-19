<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    use HasFactory;
    protected $fillable = [
        'chamado_id',
        'user_ip',
        'pais',
        'regiao',
        'cidade',
        'zip',
        'isp'
    ];
    public function chamado()
    {
        return $this->belongsTo(Chamado::class);
    }
}
