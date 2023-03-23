<?php

namespace App\Models;

use App\Models\Agent;
use App\Models\Banque;
use App\Models\Caisse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salaire extends Model
{
    use HasFactory;
    protected $fillable = [
        "montant_salaire",
    ];
    public function caisses():HasMany {
        return $this->hasMany(Caisse::class);
    }
    public function banques():HasMany {
        return $this->hasMany(Banque::class);
    }
    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
