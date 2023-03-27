<?php

namespace App\Models;

use App\Models\Salaire;
use App\Models\Prestataire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        "montant",
        "etat",
        "type_id",
        "prestataire_id",
        "salaire_id",
    ];
    public function salaire(){
        return $this->belongsTo(Salaire::class,'salaire_id')->withDefault();
    }public function prestataire(){
        return $this->belongsTo(Prestataire::class,'prestataire_id')->withDefault();
    }public function type(){
        return $this->belongsTo(Type::class,'type_id')->withDefault();
    }

    public function caisses(){
        return $this->hasMany(Caisse::class);
    }
}
