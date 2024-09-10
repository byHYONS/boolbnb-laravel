
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
    
                    {{--? modale --}}
                    {{-- <div class="modale__modale holding">
                        <span class="modale__exit">CHIUDI</span>
                        <h4>Sei sicuro di voler cancellare?</h4>
                        <p>La cancellazione è irreversibile</p>
                        <form action="{{route('admin.homes.destroy', $home)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="delete" type="submit" value="Elimina Elemento">
                        </form>
                    </div> --}}
                </div>
            </div>
    
            {{--? dettaglio informazioni --}}
            <div class="card p-5">
                <h2>{{$home->title}}</h2>
                <hr class="mb-5">
    
                <div class="crd">
                    <div class="image">
                        @if ($home->image)
                        <img src="{{ asset('storage/' . $home->image)}}" alt="{{$home->slug}}">
                        @else
                        <img src="/no-image.webp" alt="no-image">
                        @endif
                    </div>
                    <div class="text">
                        <ul>
                            <li class="mb-3">
                                <span>Qualit&agrave; del Progetto: </span>{{$home->home_grade}} su 10 
                            </li>
                            <li class="mb-3">
                                <span>Categoria: </span>{{$home->market_category}}
                            </li>
                            <li class="mb-3">
                                <span>Materiale Creato: </span>{{$home->material_created}}
                            </li>
                            <li class="mb-3">
                                <span>Tecnologia Usata: </span>
                                @forelse ($home->services as $service)
                                {{ $service->name }}
                                @empty
                                Nessuna tecnologia selezionata
                            </li>
                            @endforelse
                            {{-- <li class="mb-3">
                                <span>Tipo Cliente: </span>{{$home->type?->title ?: 'Tipologia cliente non definita'}}
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <p>
                    <span>Descrizione: </span>{{$home->description}}
                </p>
                <p>
                    <span>Collaborazione: </span>
                    {{$home->collaborations}}
                </p>
                <p>
                    <span>Inizio Progetto: </span>{{ Carbon::parse($home->start_home)->format('d.m.Y') }}
                    <i class="fas fa-circle"></i>
                    <span>Fine Progetto: </span>{{ Carbon::parse($home->start_home)->format('d.m.Y') }}
                </p>
                <p>
                    <span>Link Progetto: </span> 
                    <a class="no-btn" href="{{$home->link}}" target="_blank">{{$home->link}}</a>
                </p>
    
            </div>
        </div>
    </div>
        
    @endsection
    