@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Compra Visibilità per {{ $home->title }}</h2>

    <form id="payment-form" action="{{route('payment.store', $home->slug)}}" method="POST">
        @csrf

        <div class="row">
            <!-- Cicla attraverso le opzioni di sponsorizzazione definite nel file di configurazione -->
            @foreach(config('ads') as $ad)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <!-- Radio button per selezionare il tipo di sponsorizzazione -->
                        <input type="radio" id="ad_{{ $ad['id'] }}" name="sponsorship" value="{{ $ad['id'] }}" required>
                        <label for="ad_{{ $ad['id'] }}">{{ ucfirst($ad['title']) }} Sponsorizzazione</label>
                    </div>
                    <div class="card-body">
                        <ul>
                            <!-- Durata e prezzo della sponsorizzazione -->
                            <li>Durata: {{ $ad['duration'] }} ore</li>
                            <li>Prezzo: €{{ $ad['price'] }}</li>
                            <!-- Descrizione dei vantaggi -->
                            @if ($ad['title'] == 'platinum')
                            <li>Massima priorità nei risultati di ricerca</li>
                            <li>Visibilità garantita su tutte le pagine principali</li>
                            @elseif ($ad['title'] == 'gold')
                            <li>Alta priorità nei risultati di ricerca</li>
                            <li>Visibilità in primo piano su determinate pagine</li>
                            @elseif ($ad['title'] == 'silver')
                            <li>Priorità nei risultati di ricerca</li>
                            <li>Visibilità su alcune pagine principali</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Campo nascosto per lo slug della casa -->
        <input type="hidden" id="home-slug" name="home_slug" value="{{ $home->slug }}">

        <!-- Drop-in di Braintree -->
        <div id="dropin-container" class="my-4"></div>

        {{--? --}}
        <div id="dropin-container"></div>
        <button id="submit-button" class="button button--small button--green">Paga</button>




        {{-- <button type="submit" id="submit-button" class="btn btn-primary">Paga</button> --}}
    </form>
    <!-- Bottone per tornare indietro alla show della casa -->
    <a href="{{route('admin.homes.show', $home->slug)}}">Torna indietro</a>
</div>
@endsection

@section('scripts')
<script src="https://js.braintreegateway.com/web/dropin/1.43.0/js/dropin.js"></script>
<script src="{{ asset('js/braintree.js') }}"></script>
@endsection