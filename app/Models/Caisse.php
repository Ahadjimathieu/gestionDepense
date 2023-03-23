<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "solde"
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
