<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table ='categories';

    protected function news(){
        return $this-> hasManyThrough(News::class, TypeNews::class);
    }
}
