<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chamado extends Model
{
    use HasFactory, SoftDeletes;

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

        // Boot method para aplicar cascading soft deletes
        protected static function boot()
        {
            parent::boot();

            static::deleting(function ($user) {
                if ($user->isForceDeleting()) {
                    // Se for um delete forçado, apague os chamados permanentemente
                    $user->foto()->forceDelete();
                } else {
                    // Se for um soft delete, aplique o soft delete nos chamados
                    $user->foto()->delete();
                }
            });
        }
}
