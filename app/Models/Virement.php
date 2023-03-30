<?php

namespace App\Models;

use App\Models\Banque;
use App\Models\Caisse;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Virement extends Model
{
    use HasFactory;

    protected $fillable = [
        "montant",
        "banque_id"
    ];
    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
    public function banque(){
        return $this->belongsTo(Banque::class);
    }
}
