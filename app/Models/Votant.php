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
        'prenom',
        'nom',
        'region',
        'departement',
        'commune'
    ];
    
}
