<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // List field yang boleh diisi ke database
    protected $fillable = ['title'];

    // Kebalikan dari fillable
    // protected $guarded = ['id'];

    public function product()
    {
        // return $this->hasMany('Nama Model', 'foreign_key => genre_id ditable movie');
        return $this->hasMany('App\Models\Product', 'genre_id');
    }
}
