<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    public $timestamps = true;

    public function carts()
    {
        return $this->hasMany(Cart::class, 'item_id', 'id');
    }
}
