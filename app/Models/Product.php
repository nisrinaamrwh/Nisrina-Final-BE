<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Field yg boleh diisi
    // protected $fillable = ['title', 'description', 'tahun_rilis', 'genre_id', 'user_id'];

    // Field yang gk boleh diisi
    protected $guarded = ['id'];

    public function category()
    {
        // $this->belongsTo('Model Genre', 'yg ada di table movie', 'yg ada di table genre');
        return $this->belongsTo('App\Models\Category', 'genre_id', 'id');
    }

    public function user()
    {
        // $this->belongsTo('Model Genre', 'yg ada di table movie', 'yg ada di table user');
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
