<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\File;
use App\Data;

use Auth;

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
        $data = Data::getAll('income');
        $incomeSumData = Data::sumByCategoryMonth($data);

        return view('graphs', [
            'totalIncomeByMonth' => Data::getTotalsByMonth('income'),
            'totalExpenseByMonth' => Data::getTotalsByMonth('expense'),
            'incomeSumData' => $incomeSumData
        ]);
    }


    public function viewReport($type, $year)
    {

        $allData = Data::getAll($type);
        $data[$year] = Data::sumByMonthCategory($allData);

        $catTotals = Data::getTotalsByCategory($type);
        $finalTotal = Data::getTotal($type);

        return view('reports.main', [
            'data' => $data,
            'catTotals' => $catTotals,
            'finalTotal' => $finalTotal,
            'type' => $type,
            'user' => Auth::user()
        ]);
    }

    public function report()
    {

        return view('report', [

        ]);
    }
}
