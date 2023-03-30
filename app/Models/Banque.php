<?php

namespace App\Models;

use App\Models\Virement;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banque extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom",
        "solde",
    ];
    public function operations(){
        return $this->hasMany(Operation::class);
    }

    public function virements(){
        return $this->hasMany(Virement::class);
    }
}
