<?php

namespace App\Models;

use App\Models\Banque;
use App\Models\Caisse;
use App\Models\Facture;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        "date_paiement",
        "note",
        "facture_id",
    ];
    public function caisses():HasMany {
        return $this->hasMany(Caisse::class);
    }
    public function operations():HasMany {
        return $this->hasMany(Operation::class);
    }
    public function facture(){
        return $this->belongsTo(Facture::class);
    }


}
