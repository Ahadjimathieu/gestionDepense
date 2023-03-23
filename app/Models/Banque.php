<?php

namespace App\Models;

use App\Models\Depense;
use App\Models\Salaire;
use App\Models\Paiement;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banque extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "adresse",
        "telephone"
    ];

    public function depense(){
        return $this->belongsTo(Depense::class);
    }
    public function salaire(){
        return $this->belongsTo(Salaire::class);
    }
    public function paiement(){
        return $this->belongsTo(Paiement::class);
    }
    public function operation(){
        return $this->belongsTo(Operation::class);
    }
}
