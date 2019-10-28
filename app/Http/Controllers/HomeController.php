<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\File;
use App\Data;

class HomeController extends Controller
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
    public function index()
    {
        return view('home', [ 'type' => '']);
    }


    public function income()
    {
        return view('income', [
            'type' => 'income'
        ]);
    }


    public function expense()
    {
        
        return view('income', [
            'type' => 'expense'
        ]);
    }


    public function graph()
    {

        return view('graphs', [
            'totalIncomeByMonth' => Data::getTotalsByMonth('income'),
            'totalExpenseByMonth' => Data::getTotalsByMonth('expense')
        ]);
    }


    public function report()
    {

        return view('report', [

        ]);
    }
}
