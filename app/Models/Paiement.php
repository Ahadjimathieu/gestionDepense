<?php

namespace App\Models;

use App\Models\Banque;
use App\Models\Caisse;
use App\Models\Facture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        "date_paiement",
        "montant_paiement"
    ];
    public function caisses():HasMany {
        return $this->hasMany(Caisse::class);
    }
    public function banques():HasMany {
        return $this->hasMany(Banque::class);
    }
    public function facture(){
        return $this->belongsTo(Facture::class);
    }


}
