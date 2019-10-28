<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/income', 'HomeController@income')->name('income');
Route::get('/expense', 'HomeController@expense')->name('expense');
Route::get('/graph', 'HomeController@graph')->name('graph');
Route::get('/report', 'HomeController@report')->name('report');


Route::get('/manager/getIncome', 'ManagerController@getIncome')->name('manager.income.data');
Route::get('/manager/getIncomeList', 'ManagerController@getIncomeList')->name('manager.income.list');

Route::get('/manager/getExp', 'ManagerController@getExpense')->name('manager.expense.data');
Route::get('/manager/getExpList', 'ManagerController@getExpenseList')->name('manager.expense.list');

Route::post('/manager/generateReport', 'ManagerController@generateReport')->name('manager.generateReport');
Route::get('/manager/getReportList', 'ManagerController@getReportList')->name('manager.reports.list');

Route::get('/test', 'ManagerController@test')->name('manager.test');


Route::get('/df/{id}', 'ManagerController@downloadFile')->name('manager.downloadFile');
Route::post('/uf', 'ManagerController@uploadFile')->name('manager.uploadFile');
Route::post('/sf', 'ManagerController@sortFile')->name('manager.sortFile');

// Route::get('/df/{id}', function($id = null)
// {
//     // $path = storage_path().'/imageFolder/' . $image;
//     $user = auth()->user();
//     $fileData = App\File::find($id);

//     if($user->id != $fileData->userID)
//     {
//         die('Not Allowed....');
//     }

//     // if (file_exists($path)) { 
//         return response()->file(
//         	 // Storage::disk('vault')->url($fileData->system, $fileData->original)
//         	storage_path('app'.DIRECTORY_SEPARATOR.'vault'.DIRECTORY_SEPARATOR.$fileData->system, $fileData->original)

//         );
//     // }
// });

