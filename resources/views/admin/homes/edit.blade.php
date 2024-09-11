@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h1>Aggiornamento dell'appartamento</h1>
        <!-- Formulario di edizione -->
        <form action="{{ route('admin.homes.update', $home) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
    
            {{-- <!-- Titolo -->--}}
            <div class="form-group mb-3 formcontainer ">
                <label for="title" class="@error('title') text-danger @enderror">Titolo</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                    value="{{ old('title', $home->title) }}" required>
                
                    {{-- errore --}}
                @if ($errors->has('title'))
                    <div class="invalid-feedback">
                        Error: {{ $errors->first('title') }}
                    </div>
                @endif
            </div>


            <!-- Descrizione -->
            <div class="form-group mb-3 formcontainer ">
                <label for="description" class="pt-2 @error('description') text-danger @enderror">Descrizione</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $home->description) }}</textarea>

                {{-- errore --}}
                @if ($errors->has('description'))
                    <div class="invalid-feedback">
                        Error: {{ $errors->first('description') }}
                    </div>
                @endif
            </div>
    
            <!-- Letti -->
            <div class="form-group mb-3 formcontainer flex-row ">
                <label for="beds" class="pt-2 @error('beds') text-danger @enderror">Letti</label>
                <input type="number" name="beds" class="form-control w-25  @error('beds') is-invalid @enderror" value="{{ old('beds', $home->beds) }}" required>

                {{-- errore --}}
                @if ($errors->has('beds'))
                    <div class="invalid-feedback">
                        Error: {{ $errors->first('beds') }}
                    </div>
                @endif
            </div>
    
            <!-- Bagni -->
            <div class="form-group mb-3 formcontainer flex-row">
                <label for="bathrooms" class="pt-2 @error('bathrooms') text-danger @enderror">Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control w-25  @error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms', $home->bathrooms) }}" required>

                {{-- errore --}}
                @if ($errors->has('bathrooms'))
                    <div class="invalid-feedback">
                        Error: {{ $errors->first('bathrooms') }}
                    </div>
                @endif
            </div>
    
            <!-- Stanze -->
            <div class="form-group mb-3 formcontainer flex-row">
                <label for="rooms" class="pt-2 @error('rooms') text-danger @enderror">Rooms</label>
                <input type="number" name="rooms" class="form-control w-25  @error('rooms') is-invalid @enderror" value="{{ old('rooms', $home->rooms) }}" required>
                
                {{-- errore --}}
                @if ($errors->has('rooms'))
                    <div class="invalid-feedback">
                        Error: {{ $errors->first('rooms') }}
                    </div>
                @endif
            </div>

            <!-- Metri quadrati (mq) -->
            <div class="form-group mb-3 formcontainer flex-row">
                <label for="square_metres" class="pt-2 @error('square_metres') text-danger @enderror">Metri quadrati (mq)</label>
                <input type="number" name="square_metres" class="form-control w-25  @error('square_metres') is-invalid @enderror" value="{{ old('square_metres', $home->square_metres) }}" required>
                
                {{-- errore --}}
                @if ($errors->has('square_metres'))
                    <div class="invalid-feedback">
                        Error: {{ $errors->first('square_metres') }}
                    </div>
                @endif
            </div>


    
            <!-- Indirizzo -->
            <div class="form-group mb-3 formcontainer ">
                <label for="address" class="@error('address') text-danger @enderror">Address</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $home->address) }}" required>

                {{-- errore --}}
                @if ($errors->has('address'))
                    <div class="invalid-feedback">
                        Error: {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
    
            <!-- Servizi -->
            <div class="form-group mb-3">
                <label for="services">Services</label>
                <div class="d-flex">
                    @foreach ($services as $service)
                        <div class="form-check px-5">
                            <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}"
                                {{ in_array($service->id, $home->services->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label class="form-check-label" for="service{{ $service->id }}">
                                {{ $service->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Immagini--}}
    
            <div class="mb-3 ">
                <label for="images" class="form-label">Immagini</label>
                <input type="file" class="form-control" id="images" name="image" multiple>
            </div>

            
            <div class="form-check mb-3">
                <input type="hidden" name="active" value="0">
                <input class="form-check-input" type="checkbox" name="active" id="active" value="1" 
                    {{ old('active', $home->active) == 1 ? 'checked' : '' }}>

                <label class="form-check-label" for="active"> Visibile </label>
            </div>

         
            <!-- Aggiornamento -->
            <button  class="effect mb-3">Aggiorna</button>
        </form>

    </div>
@endsection