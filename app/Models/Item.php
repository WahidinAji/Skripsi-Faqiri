<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;

    public function transactions()
    {
        return $this->hasOne(Transaction::class);
    }
    public function transactionsMany()
    {
        return $this->hasMany(Transaction::class);
    }
}
