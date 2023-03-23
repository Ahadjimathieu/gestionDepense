<?php

namespace App\Models;

use App\Models\Facture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        "designation",
        "quantite",
        "prix_unit",
        "total",
        "facture_id",

    ];

    public function facture(){
        return $this->belongsTo(Facture::class);
    }
}
