<?php

namespace App\Models;

use App\Models\Caisse;
use App\Models\Depense;
use App\Models\Paiement;
use App\Models\Virement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "montant",
        "type",
        "operation",
        "paiement_id",
        "depense_id",
    ];
    public function paiement(){
        return $this->belongsTo(Paiement::class,'paiement_id')->withDefault();
    }
    public function virements(){
        return $this->hasMany(Virement::class);
    }
    public function depense(){
        return $this->belongsTo(Depense::class,'depense_id')->withDefault();
    }

}
