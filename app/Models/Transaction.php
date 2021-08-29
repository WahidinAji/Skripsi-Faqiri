<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public $timestamps = true;
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    // public function getRouteKeyName()
    // {
    //     return 'code';
    // }
}
