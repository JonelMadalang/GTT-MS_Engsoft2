@extends('layouts.admin_app')

@section('content')
 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 

    <h2 style="text-align: center;">Boundary and Expenses chart</h2>
    <div class="container-fluid p-5">
    <div id="barchart_material" style="width: 100%; height: 500px;"></div>
    </div>
 
    <script type="text/javascript">
 
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
 
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [ 'month', 'Boundary', 'Expenses'],
 
            @php
              foreach($transactions as $transaction) {
                echo "['".$transaction->date."', ".$transaction->boundary.", ".$transaction->expenses."],";
              }
            @endphp
        ]);
 
        var options = {
          chart: {
            title: '2021',
            subtitle: '',
          },
          bars: 'vertical'
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

@endsection