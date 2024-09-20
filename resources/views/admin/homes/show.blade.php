@extends('layouts.app')

@section('content')

<div class="home-show p-5">
    <div class="container">
        <div class="button-manage">
            {{--? bottone indietro --}}
            <div class="back">
                <a href="{{route('admin.homes.index') }}">{{ __('Indietro')}}</a>
            </div>

            {{--? bottoni gestione --}}
            <div class="manage">
                <div class="create">
                    <a href="{{route('admin.homes.create') }}">{{ __('Crea Nuovo')}}</a>
                </div>
                <a href="{{route('admin.homes.edit', $home)}}" class="ml-45 mr-10">
                    <i class="fas fa-pen"></i>
                </a>
                <form action="{{route('admin.homes.destroy', $home)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="border-0 bg-transparent"><a href=""><i class="fas fa-trash"></i></a></button>
                </form>

            </div>
        </div>

        {{--? dettaglio informazioni --}}
        <div class="card p-5">
            <h2>{{$home->title}}</h2>
            <hr class="mb-5">

            <div class="crd">
                <div class="image">
                    {{--? immagine da url --}}
                    @if (Str::startsWith($home->image, 'http'))
                    <img src="{{ $home->image }}" alt="{{ $home->title }}" class="rounded">
                    @else
                    {{--? immagine da storage --}}
                    <img src="{{ asset('storage/' . $home->image) }}" alt="{{ $home->title }}" class="rounded">
                    @endif
                </div>
                <div class="text">
                    <ul>
                        <li class="mb-3">
                            <span>Indirizzo: </span>{{$home->address}}
                        </li>
                        <li class="mb-3">
                            <span>Numero Stanze: </span>{{$home->rooms}}
                        </li>
                        <li class="mb-3">
                            <span>Numero Letti: </span>{{$home->beds}}
                        </li>
                        <li class="mb-3">
                            <span>Numero Bagni: </span>{{$home->bathrooms}}
                        </li>
                        <li class="mb-3">
                            <span>Superficie: </span>{{$home->square_metres}} mq
                        </li>
                        <li class="mb-3">
                            <span>Servizi: </span>
                            @forelse ($home->services as $service)
                            {{ $service->name }} {{ !$loop->last ? ',' : '' }}
                            @empty
                            Nessuna servizio selezionato
                            @endforelse
                        </li>


                    </ul>
                </div>
            </div>
            <p>
                <span>Descrizione: </span>{{$home->description}}
            </p>

            {{--? visualizzazioni & bottone per la sponsorizzazione --}}
            <div class="view-ads">
                <div class="view">
                    <span>visualizzazioni: </span>

                </div>
                <div class="ads">
                    <a href="{{ route('payment.form', $home->slug) }}" class="btn btn-primary">
                        Compra Visibilità
                    </a>
                </div>
            </div>

            <hr class="mt-4">
            {{--? messaggi da frontend: --}}
            <div class="row row-gap-3 my-4">
                <h3 class="com">Messaggi:</h3>
                @forelse ($home->messages->reverse() as $message)
                <div class="col-12">
                    <div class="card-body">
                        <h4 class="card-title">{{ $message ->name}}</h4>
                        <em>{{ $message ->email}}</em>
                        <p class="card-text">{{ $message ->content }}</p>
                    </div>
                </div>
                @empty
                <div class="">
                    <h3>Non ci sono messaggi</h3>
                </div>
                @endforelse
            </div>

        </div>
    </div>

    @endsection