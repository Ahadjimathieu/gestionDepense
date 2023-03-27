<?php

namespace App\Models;

use App\Models\Banque;
use App\Models\Caisse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Virement extends Model
{
    use HasFactory;

    protected $fillable = [
        "banque_id"
    ];
    public function caisses(){
        return $this->hasMany(Caisse::class);
    }
    public function banque(){
        return $this->belongsTo(Banque::class);
    }
}
