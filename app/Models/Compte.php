<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $fillable = [
        'iban',
        'alias',
        'tipus_compte_id',
        'client_id',
        'saldo',
    ];

    // Un compte és d'un client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Un compte és d'un tipus
    public function tipusCompte()
    {
        return $this->belongsTo(TipusCompte::class);
    }

    // Un compte pot fer molts bizums
    public function bizums()
    {
        return $this->hasMany(Bizum::class, 'compte_origen_id');
    }
}