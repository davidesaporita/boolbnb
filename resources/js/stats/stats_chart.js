let url = window.location.protocol + '//' + window.location.host + '/' +'api/stats/query';
console.log('test');

	// $.ajax({
	// 	url,
	// 	method: "GET",
	// 	data: {
	// 		apartment_id : {{ $apartment->id }}
	// 	},
	// }).done(function(result) {

	// 	console.log(result)

	// }).fail(function() {

	// 	console.log('Ajax Request Error')

	// })

    // var ctx = document.getElementById('myChart');
    // var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    //         datasets: [{
    //             label: '# views',
    //             backgroundColor: 'lightblue',
    //             fill: false,
    //             borderColor: '#000',
    //             data: ['{{$views['0']['views']}}', '{{$views['1']['views']}}', '{{$views['2']['views']}}', '{{$views['3']['views']}}', '{{$views['4']['views']}}', '{{$views['5']['views']}}', '{{$views['6']['views']}}'],
	// 		},
	// 		{
    //             label: '# InfoRequest',
    //             backgroundColor: 'orange',
    //             fill: false,
    //             borderColor: 'orange',
    //             data: ['{{$info_requests['0']['info_requests']}}', '{{$info_requests['1']['info_requests']}}', '{{$info_requests['2']['info_requests']}}', '{{$info_requests['3']['info_requests']}}', '{{$info_requests['4']['info_requests']}}', '{{$info_requests['5']['info_requests']}}', '{{$apartment->views}}'],
	// 		},
	// 		{
    //             label: '# Reviews',
    //             backgroundColor: 'red',
    //             fill: false,
    //             borderColor: 'red',
    //             data: ['{{$reviews['0']['reviews']}}', '{{$reviews['1']['reviews']}}', '{{$reviews['2']['reviews']}}', '{{$reviews['3']['reviews']}}', '{{$reviews['4']['reviews']}}', '{{$reviews['5']['reviews']}}', '{{$reviews['6']['reviews']}}'],
    //         }]
    //     },
    //     options: {
	// 			responsive: true,
	// 			title: {
	// 				display: true,
	// 				text: 'Visualizzazioni'
	// 			},
	// 			tooltips: {
	// 				mode: 'index',
	// 				intersect: false,
	// 			},
	// 			hover: {
	// 				mode: 'nearest',
	// 				intersect: true
	// 			},
	// 			scales: {
	// 				x: {
	// 					display: true,
	// 					scaleLabel: {
	// 						display: true,
							
	// 					}
	// 				},
	// 				y: {
	// 					display: true,
	// 					scaleLabel: {
	// 						display: true,
							
	// 					}
	// 				}
	// 			}
	// 		}
    // });