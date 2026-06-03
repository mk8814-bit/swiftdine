<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    use HasFactory;
    
    protected $fillable = ['inventory_id', 'type', 'quantity', 'date', 'description'];

    public function inventory() {
        return $this->belongsTo(Inventory::class);
    }
}
