@extends('layouts.internal')

@section('js-links')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', @foreach(\App\Data::categories() as $catID => $catTitle)
              '{{$catTitle}}', @endforeach ],




          @foreach(\App\Data::months() as $num => $month)
            ['{{$month}}',  
              @foreach(\App\Data::categories() as $catID => $catTitle)
                {{ isset($incomeSumData[$num][$catID]) ? $incomeSumData[$num][$catID] : 0 }},
              @endforeach

            ],
            


          @endforeach
          
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
@endsection

@section('content')
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
@endsection