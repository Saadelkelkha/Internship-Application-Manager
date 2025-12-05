<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demande extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id_user',
        'etablissement',
        'telephone',
        'type_stage',
        'date_debut',
        'date_fin',
        'competences',
        'service',
        'lettre_motivation',
        'cv',
        'lettre_de_recommandation',
    ];
}
