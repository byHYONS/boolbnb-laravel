@extends('layouts.app')

@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row justify-content-center" id="houdini">
            <div class="col mt-4">
                <div class="form">
                    <div class="form-header">{{ __('Dashboard') }}</div>

                    <div class="form-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <h3 class="ms-4">Le tue visite:</h3>
            <div class="chart-container mt-3 w-75 h-50" data-visitors='@php echo json_encode($visitors); @endphp'>
                <canvas id="chart" class="w-75 h-50"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="{{ asset('js/visuals.js') }}"></script>
<script src="{{ asset('js/timeout.js') }}"></script>
@endsection