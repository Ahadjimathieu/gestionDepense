<?php

namespace App\Models;

use App\Models\DetailCommande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'prix',
    ];

    public function detailcommandes(){
        return $this->hasMany(DetailCommande::class);
    }

}
