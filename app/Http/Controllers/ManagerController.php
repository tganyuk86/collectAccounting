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

        $out = Data::getListFor('income');

        return response()->json($out);
    }

    public function getExpenseList()
    {

        $out = Data::getListFor('expense');

        return response()->json($out);
    }


    public function getIncome()
    {

        $out = Data::getFoldersFor('income');

        return response()->json($out);//->header('Content-Type', 'application/json');
    }

    public function getExpense()
    {

        $out = Data::getFoldersFor('expense');

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

    public function sortFile(Request $request)
    {
        $fileData = File::find($request->id);

        $data = Data::create([
            'categoryID' => $request->cat,
            'value' => $request->value,
            'description' => $request->description,
            'dated_at' => $request->dated_at,
            'type' => $request->type,
            'userID' => auth()->user()->id

        ]);

        $user = auth()->user();

        $newPath = $user->id.'/'.$request->type.'/'.now().substr($fileData->system, -4);

        Storage::disk('vault')->move($fileData->system, $newPath);

        $fileData->update([
            'dataID' => $data->id,
            'system' => $newPath
        ]);

        return response([
            'status' => '1'

        ]);
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

        // $text = (new TesseractOCR($resize_image->encode()))->run();
        // $rows = explode("\n", $text);
        // dd($rows);
        
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
