{{-- {{-- @extends('layouts.app') --}}

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

@endsection