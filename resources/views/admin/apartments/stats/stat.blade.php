@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body w-50">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: '# views',
                backgroundColor: 'lightblue',
                fill: true,
                borderColor: '#000',
                data: ['26', '8', '12', '24', '25', '18', '{{$apartment->views}}'],
            }]
        },
        options: {
				responsive: true,
				title: {
					display: true,
					text: 'Visualizzazioni'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					x: {
						display: true,
						scaleLabel: {
							display: true,
							
						}
					},
					y: {
						display: true,
						scaleLabel: {
							display: true,
							
						}
					}
				}
			}
    });
</script>


@endsection