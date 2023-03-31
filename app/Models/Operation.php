<?php

namespace App\Models;

use App\Models\Banque;
use App\Models\Paiement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operation extends Model
{
    use HasFactory;
    protected $fillable = [
        "etat",
        "montant",
        "type",
        "numero_ordre",
        "numero_compte",
        "paiement_id",
         "banque_id",
         "depense_id",
    ];
    public function banque(){
        return $this->belongsTo(Banque::class,'banque_id')->withDefault();
    }

    public function depense(){
        return $this->belongsTo(Depense::class,'depense_id')->withDefault();
    }
    public function paiement(){
        return $this->belongsTo(Paiement::class,'paiement_id')->withDefault();
    }
}
