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
        'couleur_id',
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

    public function avis()
    {
        return $this->hasMany(AvisMeubles::class, 'id_meuble');
    }

    public function couleur()
    {
        return $this->belongsTo(Couleur::class);
    }
}
