<?php

namespace App\Models;

use App\Models\Depense;
use App\Models\Paiement;
use App\Models\Virement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caisse extends Model
{
    use HasFactory;
    protected $fillable = [
        "solde",
        "paiement_id",
        "virement_id",
        "depense_id"
    ];
    public function paiement(){
        return $this->belongsTo(Paiement::class,'paiement_id')->withDefault();
    }
    public function virement(){
        return $this->belongsTo(Virement::class,'virement_id')->withDefault();
    }
    public function depense(){
        return $this->belongsTo(Depense::class);
    }
}
