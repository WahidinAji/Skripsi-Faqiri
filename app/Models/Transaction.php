<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public $timestamps = true;
    public function carts()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
