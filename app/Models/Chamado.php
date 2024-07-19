<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'geolocalizacao',
        'anotacao_samu',
        'situacao'
    ];
    public function foto()
    {
        return $this->hasMany(Foto::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cartao()
    {
        return $this->belongsToMany(Cartao::class);
    }
    public function ip()
    {
        return $this->hasOne(Ip::class);
    }
}
