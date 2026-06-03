<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPackage extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description', 'price', 'image', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function menus() {
        return $this->belongsToMany(Menu::class)->withPivot('quantity')->withTimestamps();
    }
}
