<?php

namespace App\Models;

use App\Models\Depense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestataire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function depenses(){
        return $this->hasMany(Depense::class);
    }
}
