@extends('layouts.app')

@section('content')

<div class="container">
    <div class="wrap-stats-box text-center">
        <h2>Ecco le Statistiche del tuo Appartamento:</h2>
        <h3>{{ $apartment->title . ', ' . $apartment->city . ', ' . $apartment->region . ', ' . $apartment->country}} </h3>

            <div class="wrap-stats d-flex flex-wrap justify-content-between">
                <canvas id="myChart-views" width="400" height="400"></canvas>
                <canvas id="myChart-messages" width="400" height="400"></canvas>
                <canvas id="myChart-reviews" width="400" height="400"></canvas>
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
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
    var messages = [];
    var reviews = [];

    
    
    monthly_stats.forEach(item => {
        date.push(item.date);
        views.push(item.views);
        messages.push(item.messages);
        reviews.push(item.reviews);
    })

    // total
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
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
                data: messages,
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

    // views
    var ctxViews = document.getElementById('myChart-views').getContext('2d');
    var myChartViews = new Chart(ctxViews, {
        type: 'line',
        data: {
            labels: date,
            datasets: [{
                label: 'Visualizzazioni',
                data: views,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
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

    // message
    var ctxMessages = document.getElementById('myChart-messages').getContext('2d');
    var myChartMessages = new Chart(ctxMessages, {
        type: 'line',
        data: {
            labels: date,
            datasets: [
            {
                label: 'Richieste info',
                data: messages,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
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

    // reviews
    var ctxReviews = document.getElementById('myChart-reviews').getContext('2d');
    var myChartReviews = new Chart(ctxReviews, {
        type: 'line',
        data: {
            labels: date,
            datasets: [
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