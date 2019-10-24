<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use thiagoalessio\TesseractOCR\TesseractOCR;


class Data extends Model
{
    protected $fillable = [
        'userID', 'categoryID', 'value', 'description', 'dated_at'
    ];


    protected $casts = [
        'dated_at' => 'datetime',
    ];



}
