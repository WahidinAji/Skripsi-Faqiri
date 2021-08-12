<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
