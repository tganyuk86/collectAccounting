@extends('layouts.internal')

@section('js-links')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Income', 'Expenses'],
          @foreach(\App\Data::months() as $num => $month)
            ['{{$month}}',  {{$totalIncomeByMonth[$num]}},  {{$totalExpenseByMonth[$num]}}],
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