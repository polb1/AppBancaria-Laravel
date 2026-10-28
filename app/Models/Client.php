<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'dni',
        'data_naixament',
        'telefon',
    ];

    

    //Un client pertany a un sol usuari (És la regla 1:1)
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Un client pot tenir molts comptes (1:N)
    public function comptes(){
        return $this->hasMany(Compte::class);
    }
}
