<?php

namespace App\Models;

use App\Models\Salaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "prenom",
        "telephone",
        "adresse",
        "date_embauche"
    ];
    public function salaires():HasMany {
        return $this->hasMany(Salaire::class);
    }
}


