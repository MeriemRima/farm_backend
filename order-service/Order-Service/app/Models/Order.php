<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Indique les colonnes qui peuvent être massivement assignées
    protected $fillable = ['user_id', 'product_id', 'quantity', 'status'];

    /**
     * Relation avec User
     */
}