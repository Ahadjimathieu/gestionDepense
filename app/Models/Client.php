<?php

namespace App\Models;

use App\Models\Facture;
use App\Models\Commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "prenom",
        "telephone",
        "adresse",
    ];
    public function factures():HasMany {
        return $this->hasMany(Facture::class);
    }

    public function commandes():HasMany {
        return $this->hasMany(Commande::class);
    }
}
