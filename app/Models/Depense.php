<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depense extends Model
{
    use HasFactory;
    protected $fillable = [
        "libelle",
    ];
    public function caisses():HasMany {
        return $this->hasMany(Caisse::class);
    }
    public function banques():HasMany {
        return $this->hasMany(Banque::class);
    }
}
