<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Indiquer les colonnes mass assignables
    protected $fillable = ['name', 'description', 'price', 'quantity'];

    /**
     * Relation avec les commandes
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
