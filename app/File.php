<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use PDF;
use Storage;

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

    public static function getArchive()
    {
      $zip_file = 'archive.zip';
      $zip = new \ZipArchive();
      $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

      $path = storage_path('app/vault/'.auth()->user()->id);
      $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
      
// dd($files);
      foreach ($files as $name => $file)
      {
          // We're skipping all subfolders
          if (!$file->isDir()) {
              $filePath     = $file->getRealPath();

              // extracting filename with substr/strlen
              $relativePath = 'reciepts/' . substr($filePath, strlen($path) + 1);

              $zip->addFile($filePath, $relativePath);
          }
      }
      $zip->close();
      return response()->download($zip_file);
    }

}
