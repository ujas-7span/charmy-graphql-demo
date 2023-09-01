<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $table = "country";
    protected $fillable = ["name"];


    function scopeSearch($query, $search)
    {
        return $query->where("name", "likes", "%" . $search . "%");
    }
}
