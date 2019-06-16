<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    // Tous les champs peuvent être assinés
    protected $guarded = [];

    // Relation tables
    // Une annonce appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
