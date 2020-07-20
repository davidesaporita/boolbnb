@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body w-50">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>

{{-- TODO: proper link installed chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="{{ asset('js/stats/stats_chart.js') }}"></script>

<script>

    var monthly_stats = @json($monthly_stats);
    var date = [];
    var views = [];
    var info_requests = [];
    var reviews = [];
    
    monthly_stats.forEach(item => {
        date.push(item.date);
        views.push(item.views);
        info_requests.push(item.info_requests);
        reviews.push(item.reviews);
    })

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: date,
            datasets: [{
                label: 'Visualizzazioni',
                data: views,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Richieste info',
                data: info_requests,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Recensioni',
                data: reviews,
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
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