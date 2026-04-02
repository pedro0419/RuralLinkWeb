<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    protected $fillable = [
        'user_id',
        'foto',
        'nome',
        'selo',
        'preco_kg',
        'quantidade',
        'descricao'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

