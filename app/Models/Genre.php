<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    // List field yang boleh diisi ke database
    protected $fillable = ['title'];

    // Kebalikan dari fillable
    // protected $guarded = ['id'];

    public function movie()
    {
        // return $this->hasMany('Nama Model', 'foreign_key => genre_id ditable movie');
        return $this->hasMany('App\Models\Movie', 'genre_id');
    }
}
