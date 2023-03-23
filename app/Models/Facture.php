<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Detail;
use App\Models\Paiement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        "numero_facture",
        "montant",
        "montant_restant",
        "etat",
        "client_id"
    ];
    public function paiements():HasMany {
        return $this->hasMany(Paiement::class);
    }

    public function details():HasMany {
        return $this->hasMany(Detail::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }

}
