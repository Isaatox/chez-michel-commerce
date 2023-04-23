<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meuble extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nom',
        'categorie',
        'couleur',
        'description',
        'stock',
        'note',
        'prix',
        'photo1',
        'photo2',
        'photo3',
    ];

    protected $casts = [
        'date_ajout' => 'datetime',
    ];

    public function couleur()
    {
        return $this->belongsTo(Couleur::class);
    }
}
