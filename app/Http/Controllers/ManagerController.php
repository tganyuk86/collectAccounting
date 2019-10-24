<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\Storage;


use App\Data;
use App\File;
use App\Category;

use Image;


class ManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIncomeList()
    {
        $data =  [];//"[{'label':'HTML','value':'html','children':[{'label':'HTML5','value':'html5'},{'label':'XML','value':'xml'}]},{'label':'JavaScript','value':'javaScript','children':[{'label':'React','value':'react','children':[{'label':'ReactNative','value':'reactnative'}]},{'label':'Angular','value':'angular'}]}]";

        $allData = Data::all();
        $allCats = Category::all();

        foreach($allData as $row)
        {

            $data[$row->dated_at->year][$row->dated_at->month][$row->categoryID] = $row->description;
        }

        $out = [];
        $index = 0;

        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'March',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sept',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec',
        ];

        foreach($data as $year => $d2)
        {
            // $out['label'] = $year;
            // $out['value'] = $year;

            $out[$index] = [
                    'label' => $year,
                    'value' => 'files/Y:'.$year
                ];
            // $out['children'] = $d2;

            $index2 = 0;
            foreach($months as $month => $monthLabel)
            {


                $out[$index]['children'][$index2] = [
                    'label' => $monthLabel,
                    'value' => 'files/Y:'.$year.'/'.$monthLabel,
                    // 'children' => $d3
                ];

                // $data['children'] = $d3;

                foreach($allCats as $cat)
                {
                    $out[$index]['children'][$index2]['children'][] = [
                        'label' => $cat->title,
                        'value' => 'files/Y:'.$year.'/'.$months[$month].'/'.$cat->title
                    ];
                    // $dd['label'] = $cat;

                }

                $index2++;

            }

            $index++;

        }

        // dd($out);

        return response()->json($out);//header('Content-Type', 'application/json');
    }


    public function getIncome()
    {

        $out = [
            "name" => "files",
            "type" => "folder",
            "path" => "files"
        ];

        $allData = Data::all();
        // $allCats = Category::all();

        foreach($allData as $row)
        {

            $data[$row->dated_at->year][$row->dated_at->month][$row->categoryID] = $row->description;
        }


        $index = 0;

        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'March',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sept',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec',
        ];

        foreach($data as $year => $d2)
        {
           
            $out['items'][$index] = [
                "name" => 'Y:'.$year,
                "type" => "folder",
                "path" => "files/Y:$year"
            ];

            $index2 = 0;
            foreach($d2 as $month => $d3)
            {


                $out['items'][$index]['items'][$index2] = [
                    "name" => $months[$month],
                    "type" => "folder",
                    "path" => "files/Y:$year/{$months[$month]}"
                ];

              
                // $data['children'] = $d3;

                foreach($d3 as $cat => $dd)
                {
                    $out['items'][$index]['items'][$index2]['items'][] = [
                        "name" => Category::find($cat)->title,
                        "type" => "folder",
                        "path" => "files/Y:$year/{$months[$month]}/".Category::find($cat)->title,
                        "items" => []
                    ];

                }

                $index2++;

            }

            $index++;

        }
        // echo json_encode(array(
        //     "name" => "files",
        //     "type" => "folder",
        //     "path" => 'paath',
        //     "items" => []
        // ));
        $raw = '{"name":"files","type":"folder","path":"files","items":[{"name":"Archives","type":"folder","path":"files\/Archives","items":[{"name":"7z","type":"folder","path":"files\/Archives\/7z","items":[{"name":"archive.7z","type":"file","path":"files\/Archives\/7z\/archive.7z","size":257}]},{"name":"targz","type":"folder","path":"files\/Archives\/targz","items":[{"name":"archive.tar.gz","type":"file","path":"files\/Archives\/targz\/archive.tar.gz","size":10074}]},{"name":"zip","type":"folder","path":"files\/Archives\/zip","items":[{"name":"archive.zip","type":"file","path":"files\/Archives\/zip\/archive.zip","size":10133}]}]},{"name":"Important Documents","type":"folder","path":"files\/Important Documents","items":[{"name":"Microsoft Office","type":"folder","path":"files\/Important Documents\/Microsoft Office","items":[{"name":"Geography.doc","type":"file","path":"files\/Important Documents\/Microsoft Office\/Geography.doc","size":4096},{"name":"Table.xls","type":"file","path":"files\/Important Documents\/Microsoft Office\/Table.xls","size":204800}]},{"name":"export.csv","type":"file","path":"files\/Important Documents\/export.csv","size":4096}]},{"name":"Movies","type":"folder","path":"files\/Movies","items":[{"name":"Conan The Librarian.mkv","type":"file","path":"files\/Movies\/Conan The Librarian.mkv","size":0}]},{"name":"Music","type":"folder","path":"files\/Music","items":[{"name":"awesome soundtrack.mp3","type":"file","path":"files\/Music\/awesome soundtrack.mp3","size":10240000},{"name":"hello world.mp3","type":"file","path":"files\/Music\/hello world.mp3","size":204800},{"name":"u2","type":"folder","path":"files\/Music\/u2","items":[{"name":"Unwanted Album","type":"folder","path":"files\/Music\/u2\/Unwanted Album","items":[{"name":"track1.mp3","type":"file","path":"files\/Music\/u2\/Unwanted Album\/track1.mp3","size":204800},{"name":"track2.mp3","type":"file","path":"files\/Music\/u2\/Unwanted Album\/track2.mp3","size":204800},{"name":"track3.mp3","type":"file","path":"files\/Music\/u2\/Unwanted Album\/track3.mp3","size":204800},{"name":"track4.mp3","type":"file","path":"files\/Music\/u2\/Unwanted Album\/track4.mp3","size":204800}]}]}]},{"name":"Nothing here","type":"folder","path":"files\/Nothing here","items":[]},{"name":"Photos","type":"folder","path":"files\/Photos","items":[{"name":"pic1.jpg","type":"file","path":"files\/Photos\/pic1.jpg","size":204800},{"name":"pic2.jpg","type":"file","path":"files\/Photos\/pic2.jpg","size":204800},{"name":"pic3.png","type":"file","path":"files\/Photos\/pic3.png","size":204800},{"name":"pic4.gif","type":"file","path":"files\/Photos\/pic4.gif","size":204800},{"name":"pic5.jpg","type":"file","path":"files\/Photos\/pic5.jpg","size":204800}]},{"name":"Readme.html","type":"file","path":"files\/Readme.html","size":344}]}';
        // return response($raw)->header('Content-Type', 'application/json');

        return response()->json($out);//->header('Content-Type', 'application/json');
    }

    public function downloadFile($id)
    {

        $fileData = File::find($id);

        $user = auth()->user();
        if($user->id != $fileData->userID)
        {
            die('Not Allowed....');
        }

        return response()->file(storage_path('app'.DIRECTORY_SEPARATOR.'vault'.DIRECTORY_SEPARATOR.$fileData->system, $fileData->original));    
    }

    public function uploadFile(Request $request)
    {


        $user = auth()->user();
        $image = $request->file('myImage');
        $folder = "{$user->id}/unsorted";
        $name = str_random(25).'.'.$image->getClientOriginalExtension();
        // $file = $image->storeAs($folder, $name, [ 'disk' => 'vault' ]);

        $resize_image = Image::make($image)->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
        });//->save($folder . '/' . $image_name);

        $path = "$folder/$name";
        Storage::disk('vault')->put($path, (string) $resize_image->encode());


        $fileData = File::create([
            'original' => $image->getClientOriginalName(),
            'system' => $path,
            'userID' => $user->id
        ]);

        $text = (new TesseractOCR($resize_image->path))->run();
        $rows = explode("\n", $text);
        dd($rows);
        
        return response([
            'status' => '1',
            'id' => $fileData->id,

        ]);
        

        // Return user back and show a flash message
        // return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }



    public function test()
    {
        $text = (new TesseractOCR(storage_path().'/app/public/uploads/images/admin_1571848971.png'))->run();
        $rows = explode("\n", $text);

        dd($rows);
    } 


}
