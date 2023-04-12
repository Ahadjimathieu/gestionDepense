<?php

namespace App\Models;

use App\Models\Client;
use App\Models\DetailCommande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_commande',
        'total',
        'livraison',
        'validation',
        'client_id'
    ];

    public function detailcommandes(){
        return $this->hasMany(DetailCommande::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
