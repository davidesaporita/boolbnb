@extends('layouts.app')

@section('content')

<canvas id="myChart" width="400" height="400"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['start','views'],
            datasets: [{
                label: '# views',
                data: ['0', '{{$apartment->views}}'],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>


@endsection