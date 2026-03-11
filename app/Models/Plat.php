<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
