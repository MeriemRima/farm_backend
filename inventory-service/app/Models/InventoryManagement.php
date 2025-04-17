<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryManagement extends Model
{
    protected $table = 'inventory_managements'; // Specify the table name
    protected $fillable = ['product_id', 'stock']; // Allow mass assignment
}
