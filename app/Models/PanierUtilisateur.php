<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanierUtilisateur extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'panier_utilisateurs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'nom', 'actif',
    ];

    public function panierItems()
    {
        return $this->hasMany(PanierItem::class, 'id_panier_utilisateur');
    }
}
