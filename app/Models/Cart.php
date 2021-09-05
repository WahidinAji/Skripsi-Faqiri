<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['item_id', 'price', 'name', 'total', 'status', 'code'];
    public $timestamps = true;
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
