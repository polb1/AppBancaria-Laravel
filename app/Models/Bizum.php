<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bizum extends Model
{
    protected $fillable = [
        'compte_origen_id',
        'compte_desti_id',
        'quantitat',
    ];

    //Com tenim 2 belongsTo al nostre model de bizum, indiquem a quina columna apunta cada belongsTo
    public function compteOrigen(){
        return $this->belongsTo(Compte::class, 'compte_origen_id');
    }

    public function compteDesti(){
        return $this->belongsTo(Compte::class, 'compte_desti_id');
    }
}
