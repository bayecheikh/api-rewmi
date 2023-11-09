<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votant extends Model
{
    use HasFactory;
    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'numero_electeur',
        'prenom_nom',
        'region',
        'departement',
        'commune'
    ];

    public function electeurs()
    {
        return $this->hasMany(Electeur::class, 'numero_electeur_responsable', 'id');
    }
    
}
