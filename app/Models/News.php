<?php

namespace App\Models;

use Database\Factories\NewsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return NewsFactory::new();
    }
    protected $table='news';

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'id');
    }


    public function comments()
    {
        return $this->hasMany(Comments::class, 'id');
    }
}
