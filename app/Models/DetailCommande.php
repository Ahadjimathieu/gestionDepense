<?php

namespace App\Models;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailCommande extends Model
{
    use HasFactory;

    protected $filable = [
        'longueur',
        'largeur',
        'total',
        'commande_id',
        'produit_id'
    ];

    public function commande(){
        return $this->belongsTo(Commande::class);
    }
    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
