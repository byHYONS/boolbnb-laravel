@extends('layouts.app')

@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row justify-content-center">
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
    </div>
</div>
@endsection