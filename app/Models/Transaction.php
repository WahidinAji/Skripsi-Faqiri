<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public $timestamps = true;
    public function carts()
    {
        return $this->hasMany(Cart::class, 'code', 'code');
    }
}
