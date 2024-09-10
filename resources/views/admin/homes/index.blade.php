@extends('layouts.app')

@section('content')
<div class="home-index">
    <div class="container">
        <h3 class="my-3">Lista appartamenti</h3>
        <div class="row">
            <ul class="d-flex flex-wrap">
                @foreach ($homes as $apartment)
                <li class="col-3">
                    <div class="mx-2 my-3">
                        {{--? link diretto su foto --}}
                        <a href="{{ route('admin.homes.show', $apartment)}}">
                            <div class="img-container">
                                @if (Str::startsWith($apartment->image, 'http'))
                                {{--? immagine da url --}}
                                    <img src="{{ $apartment->image }}" alt="{{ $apartment->title }}" class="rounded">
                                @else
                                {{--? immagine da storage --}}
                                    <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}" class="rounded">
                                @endif
                            </div>
                        </a>
                        <p class="title"><strong>{{$apartment['title']}}</strong></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
