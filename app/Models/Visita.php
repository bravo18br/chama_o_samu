<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visita extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'rota',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
