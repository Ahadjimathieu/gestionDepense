<?php

namespace App\Models;

use App\Models\Agent;
use App\Models\Banque;
use App\Models\Caisse;
use App\Models\Depense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salaire extends Model
{
    use HasFactory;
    protected $fillable = [
        "montant_salaire",
        "date_salaire",
    ];
    public function depense():HasMany {
        return $this->hasMany(Depense::class);
    }
  
    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
