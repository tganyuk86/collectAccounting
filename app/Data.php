<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use thiagoalessio\TesseractOCR\TesseractOCR;


class Data extends Model
{
    protected $fillable = [
        'userID', 'categoryID', 'value', 'description', 'dated_at', 'type'
    ];


    protected $casts = [
        'dated_at' => 'datetime',
    ];


    public static function getFoldersFor($type)
    {

        $data = Data::getAllByTypeSorted($type);
    	
    	$type = ucfirst($type);
        $out = [
            "name" => "$type",
            "type" => "folder",
            "path" => "$type"
        ];


        $index = 0;

        $months = Data::months();

        foreach($data as $year => $d2)
        {
           
            $out['items'][$index] = [
                "name" => ''.$year,
                "type" => "folder",
                "path" => "$type/$year"
            ];

            $index2 = 0;
            foreach($d2 as $month => $d3)
            {


                $out['items'][$index]['items'][$index2] = [
                    "name" => $months[$month],
                    "type" => "folder",
                    "path" => "$type/$year/{$months[$month]}"
                ];

                foreach($d3 as $cat => $dd)
                {
                    $row = [
                        "name" => Category::find($cat)->title,
                        "type" => "folder",
                        "path" => "$type/$year/{$months[$month]}/".Category::find($cat)->title,
                        // "items" => []
                    ];

                    $allFiles = File::where('DataID', $dd->id)->get();
                    if(count($allFiles))
                        foreach($allFiles as $file)
                        {
                            $row['items'][] = [
                                "name" => $file['original'],
                                "type" => "file",
                                "path" => "/df/".$file->id,
                                "items" => []
                            ];
                        }
                    else{
                        $row['items'] = [];
                    }
                    $out['items'][$index]['items'][$index2]['items'][] = $row;

                }

                $index2++;

            }

            $index++;

        }
        
        return $out;
    }

    public static function getReportList()
    {

    	$types = [
    		'income' => Data::getAllByTypeSorted('income'),
    		'expense' => Data::getAllByTypeSorted('expense'),
    	];

    	$months = Data::months();
        $i = 0;

	    foreach($types as $type => $data)
	    {
	    	$out[$i] = [
	                    'label' => $type,
	                    'value' => "$type",
	                    'showChildren' => 1
	                ];


        	$index = 0;
	        foreach($data as $year => $d2)
	        {
	            // $out['label'] = $year;
	            // $out['value'] = $year;

	            $out[$i]['children'][$index] = [
	                    'label' => $year,
	                    'value' => "$type/$year",
	                    'showChildren' => 1
	                ];
	            // $out['children'] = $d2;

	            $index2 = 0;
	            // foreach($months as $month => $monthLabel)
	            foreach($d2 as $month => $d3)
	            {


	                $out[$i]['children'][$index]['children'][$index2] = [
	                    'label' => $months[$month],
	                    'value' => "$type/$year/$month",
	                    'showChildren' => false,
	                    'children' => []
	                ];

	                // $data['children'] = $d3;

	                // foreach($allCats as $cat)
	                // foreach($d3 as $cat => $dd)
	                // {
	                //     $row = [
	                //         'label' => Category::find($cat)->title,
	                //         'value' => "$type/$year/{$months[$month]}/".Category::find($cat)->title,
	                //         'children' => []
	                //     ];
	                   
	                //     $out[$i]['children'][$index]['children'][$index2]['children'][] = $row;


	                // }

	                $index2++;

	            }

	            $index++;

	        }

	        $i++;
	    }

        // dd($out);

        return $out;
    }

    public static function getListFor($type)
    {
    	$data = Data::getAllByTypeSorted($type);

    	$type = ucfirst($type);

    	$out = [];
        $index = 0;

        $months = Data::months();

        foreach($data as $year => $d2)
        {
            // $out['label'] = $year;
            // $out['value'] = $year;

            $out[$index] = [
                    'label' => $year,
                    'value' => "$type/$year",
                    'showChildren' => 1
                ];
            // $out['children'] = $d2;

            $index2 = 0;
            // foreach($months as $month => $monthLabel)
            foreach($d2 as $month => $d3)
            {


                $out[$index]['children'][$index2] = [
                    'label' => $months[$month],
                    'value' => "$type/$year/{$months[$month]}",
                    'showChildren' => 1
                    // 'children' => $d3
                ];

                // $data['children'] = $d3;

                // foreach($allCats as $cat)
                foreach($d3 as $cat => $dd)
                {
                    $row = [
                        'label' => Category::find($cat)->title,
                        'value' => "$type/$year/{$months[$month]}/".Category::find($cat)->title
                    ];
                    // $dd['label'] = $cat;
                    $allFiles = File::where('DataID', $dd->id)->get();
                    if(count($allFiles))
                        foreach($allFiles as $file)
                        {
                            $row['children'][] = [
                                "label" => $file['original'],
                                "value" => "file",
                               
                            ];
                        }
                    else{
                        $row['children'] = [];
                    }
                    $out[$index]['children'][$index2]['children'][] = $row;


                }

                $index2++;

            }

            $index++;

        }

        // dd($out);

        return $out;
    }

    public static function getAllByTypeSorted($type)
    {
    	$allData = Data::getAll($type);
    	$out = [];
    	foreach($allData as $row)
        {

            $out[$row->dated_at->year][$row->dated_at->month][$row->categoryID] = $row;
        }

        return $out;
    }

    public static function getTotal($type)
    {
    	return Data::where('type', $type)->sum('value');
    }

    public static function getTotalsByMonth($type)
    {
        $data = Data::getAll($type);

        $out = [];
        while(count($out) < 13)
            $out[] = 0;

        foreach($data as $d)
        {

            $out[$d->dated_at->month] += $d->value;
        }

        return $out;
    }

    public static function getTotalsByCategory($type)
    {
    	$data = Data::getAll($type);

    	$out = [];
    	
    	foreach($data as $d)
    	{
            if(!isset($out[$d->categoryID]))
                $out[$d->categoryID] = 0;
            
    		$out[$d->categoryID] += $d->value;
    	}

    	return $out;
    }



    //===========================================================

    public static function getAll($type = 'income')
    {
        return Data::where('type', $type)->where('userID', auth()->user()->id)->get();
    }


    public static function sumByMonthCategory($data)
    {
        $out = [];

        foreach($data as $row)
        {
            if(!isset($out[$row->dated_at->month][Data::categories()[$row->categoryID]]))
                $out[$row->dated_at->month][Data::categories()[$row->categoryID]] = 0;


            $out[$row->dated_at->month][Data::categories()[$row->categoryID]] += $row->value;
        }

        return $out;
    }

    public static function sumByCategoryMonth($data)
    {
        // $categories = Category::all();
        $out = [];

        foreach($data as $row)
        {
            if(!isset($out[Data::categories()[$row->categoryID]][$row->dated_at->month]))
                $out[Data::categories()[$row->categoryID]][$row->dated_at->month] = 0;


            $out[Data::categories()[$row->categoryID]][$row->dated_at->month] += $row->value;
        }

        return $out;
    }
    //===========================================================

    public static function categories()
    {
        $cats = Category::getAll();


        foreach($cats as $cat)
        {
            $out[$cat->id] = $cat->title;
        }

        return $out;
    }



    public static function months()
    {
    	return [
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
    }

}
