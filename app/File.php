<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use PDF;

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

    public static function printPDF()
    {
       // This  $data array will be passed to our PDF blade
       $data = [
          'title' => 'First PDF for Medium',
          'heading' => 'Hello from 99Points.info',
          'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged."
            ];
        
        $pdf = PDF::loadView('reports.main', $data);  
        return $pdf->download('main.pdf');
    }

}
