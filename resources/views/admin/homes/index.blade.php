@extends('layouts.app')

@section('content')

<h2 class="m-3">Lista appartamenti</h2>

<ul>
    @foreach ($apartments as $apartment)
    <li class="m-2">
        <div class="w-75">
            <div class="d-flex justify-content-between align-items-center mb-1 mt-3">
                <div>
                    <a href="{{route('admin.homes.show', $apartment)}}">
                        <span class="title"><strong>{{$apartment['title']}}</strong></span>
                    </a>
                </div>
                <div class="d-flex">
                    <a href="{{route('admin.homes.edit', $apartment)}}">
                        <button class="btn btn-outline-primary ms-4">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                    </a>
                    <button class="btn btn-outline-danger ms-3 delete-button">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            <hr>
        </div>
    </li>
    @endforeach
</ul>
@endsection