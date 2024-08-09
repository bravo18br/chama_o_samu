<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Chamado;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'cpf',
        'cep',
        'rua',
        'numero',
        'complemento',
        'celular',
        'analfabeto'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function chamados()
    {
        return $this->hasMany(Chamado::class);
    }
    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }

    // Boot method para aplicar cascading soft deletes
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->isForceDeleting()) {
                // Se for um delete forçado, apague os chamados permanentemente
                $user->chamados()->forceDelete();
            } else {
                // Se for um soft delete, aplique o soft delete nos chamados
                $user->chamados()->delete();
            }
        });
    }
}
