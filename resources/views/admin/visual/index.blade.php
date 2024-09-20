@extends('layouts.app')
@section('content')

<h3 class="m-5">Statistiche visualizzazioni</h3>
<div class="chart-container d-flex justify-content-center mt-5 w-50" data-visitors='@php echo json_encode($visitors); @endphp'>
    <canvas id="chart" class="w-75 h-50"></canvas>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="{{ asset('js/visuals.js') }}"></script>
@endsection