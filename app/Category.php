<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table = 'category';


    public static function getAll()
    {
        return Category::where('userID', auth()->user()->id)->get();
    }


    // public function 
}
