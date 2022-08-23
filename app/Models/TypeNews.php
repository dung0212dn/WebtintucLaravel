<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeNews extends Model
{
    use HasFactory;

    protected $table = 'typenews';

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'id');
    }    
}


