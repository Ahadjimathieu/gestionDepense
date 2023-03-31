<?php

namespace App\Models;

use App\Models\Salaire;
use App\Models\Operation;
use App\Models\Prestataire;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        "montant",
        "operation",
        "type",
        "prestataire_id",
        "salaire_id",
    ];
    public function salaire(){
        return $this->belongsTo(Salaire::class,'salaire_id')->withDefault();
    }public function prestataire(){
        return $this->belongsTo(Prestataire::class,'prestataire_id')->withDefault();
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function operations(){
        return $this->hasMany(Operation::class);
    }
}
