<?php

namespace App\Models;


use App\Models\Facture;
use App\Models\Operation;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        "montant_paiement",
        "note",
        "etat",
        "facture_id",
    ];
    public function transactions():HasMany {
        return $this->hasMany(Transaction::class,'paiement_id');
    }
    public function operations():HasMany {
        return $this->hasMany(Operation::class);
    }
    public function facture(){
        return $this->belongsTo(Facture::class);
    }


}
