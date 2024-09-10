@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="my-3">Lista appartamenti</h3>
    <div class="row">
        <ul class="d-flex flex-wrap">
            @foreach ($apartments as $apartment)
            <li class="col-3">
                <div class="mx-2 my-3">
                    <div class="img-container">
                        <img src="{{$apartment['image']}}" alt="img" class="rounded">
                    </div>
                    <p class="title"><strong>{{$apartment['title']}}</strong></p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection