<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['item_id', 'price', 'name', 'total', 'status'];
    public $timestamps = true;
    public function carts()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
