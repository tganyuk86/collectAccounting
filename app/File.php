<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use PDF;
use Storage;
use Auth;

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

    public static function printPDF($type, $data, $catTotals, $finalTotal)
    {
       // This  $data array will be passed to our PDF blade

        
        $pdf = PDF::loadView('reports.main', [
          'type' => $type,
          'user' => Auth::user(),
          'data' => $data,
          'catTotals' => $catTotals,
          'finalTotal' => $finalTotal
            ]);  
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
