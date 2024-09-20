@extends('layouts.app')

@section('content')
<div class="home-index">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mx-2">
            <h2 class="my-4">Lista appartamenti</h2>
            <div class="manage">
                <div class="create my-4">
                    <a href="{{route('admin.homes.create') }}">{{ __('Crea Nuovo')}}</a>
                </div>
            </div>
        </div>
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
        <div class="manage">
            <a href="{{route('admin.visual.index')}}">Statistiche</a>
        </div>
    </div>
</div>
@endsection