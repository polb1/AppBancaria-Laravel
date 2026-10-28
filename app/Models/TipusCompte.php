<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipusCompte extends Model
{
    protected $table = 'tipus_compte';
    
    protected $fillable = [
        'nom',
        'descripcio',
        'imatge',
    ];

    // Un tipus de compte pot tenir molts comptes
    public function comptes()
    {
        return $this->hasMany(Compte::class);
    }
}