@extends('layouts.app')
@section('content')

<div class="home-show">
    <div class="container">
        <h3 class="my-5">Statistiche visualizzazioni</h3>
        <div class="row card no-hover p-5">
            <div class="chart-container d-flex mt-5 w-50" data-visitors='@php echo json_encode($visitors); @endphp'>
                <canvas id="chart" class="me-4"></canvas>
                <canvas id="chart-apartments" class="ms-4"></canvas>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="{{ asset('js/visuals.js') }}"></script>
@endsection