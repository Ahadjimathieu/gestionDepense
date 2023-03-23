<?php

namespace App\Models;

use App\Models\Banque;
use App\Models\Caisse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operation extends Model
{
    use HasFactory;
    protected $fillable = [
        "montant_op",
        "type_op"
    ];
    public function caisses():HasMany {
        return $this->hasMany(Caisse::class);
    }
    public function banques():HasMany {
        return $this->hasMany(Banque::class);
    }
}
