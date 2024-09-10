
    @extends('layouts.app')
    
    @section('content')
    
    <div class="project-show p-5">
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
                    <a href="#" class="modale">
                        <i class="fas fa-trash"></i>
                    </a>
    
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
                                <span>Numero Stanze: </span>{{$home->rooms}}
                            </li>
                            <li class="mb-3">
                                <span>Nomero Bagni: </span>{{$home->bathrooms}}
                            </li>
                            <li class="mb-3">
                                <span>Superficie: </span>{{$home->square_metres}} mq
                            </li>
                            <li class="mb-3">
                                <span>Servizi: </span>
                                {{$home->services}}
                                @forelse ($home->services as $service)
                                {{ $service->name }}
                                @empty
                                Nessuna servizio selezionato
                            </li>
                            @endforelse
                        
                        </ul>
                    </div>
                </div>
                <p>
                    <span>Descrizione: </span>{{$home->description}}
                </p>
                
            </div>
        </div>
    </div>
        
    @endsection
    