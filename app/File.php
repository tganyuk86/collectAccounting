<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    protected $fillable = [
        'userID', 'dataID', 'original', 'system'
    ];

    protected $table = 'files';

    
    public function runOCR($path)
    {
		$text = (new TesseractOCR($path))->run();
        $rows = explode("\n", $text);

        return $rows;
    }


}
