@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2>Aggiornamento dell'appartamento</h2>
    <div class="button-manage my-4">
        {{--? bottone indietro --}}
        <div class="back">
            <a href="{{route('admin.homes.index') }}">{{ __('Indietro')}}</a>
        </div>
    </div>
    <!-- Formulario di edizione -->
    <form action="{{ route('admin.homes.update', $home) }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @method('PUT')
        @csrf

        {{-- <!-- Titolo -->--}}
        <div class="form-group mb-3 formcontainer ">
            <label for="title" class="@error('title') text-danger @enderror">Titolo</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $home->title) }}" required>

            @if ($errors->get('title'))
            @foreach ($errors->get('title') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>


        <!-- Descrizione -->
        <div class="form-group mb-3 formcontainer ">
            <label for="description" class="pt-2 @error('description') text-danger @enderror">Descrizione</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $home->description) }}</textarea>

            @if ($errors->get('description'))
            @foreach ($errors->get('description') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Indirizzo -->
        <div class="form-group mb-3 formcontainer ">
            <label for="address" class="@error('address') text-danger @enderror">Indirizzo</label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $home->address) }}" required>

            @if ($errors->get('address'))
            @foreach ($errors->get('address') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Letti -->
        <div class="form-group mb-3 formcontainer flex-row ">
            <div class="d-flex">
                <div class="col-2">
                    <label for="beds" class="pt-2 @error('beds') text-danger @enderror">Numero di letti</label>
                </div>
                <input type="number" name="beds" class="form-control w-25  @error('beds') is-invalid @enderror" value="{{ old('beds', $home->beds) }}" required>
            </div>

            @if ($errors->get('beds'))
            @foreach ($errors->get('beds') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Bagni -->
        <div class="form-group mb-3 formcontainer flex-row">
            <div class="d-flex">
                <div class="col-2">
                    <label for="bathrooms" class="pt-2 @error('bathrooms') text-danger @enderror">Numero di bagni</label>
                </div>
                <input type="number" name="bathrooms" class="form-control w-25  @error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms', $home->bathrooms) }}" required>
            </div>

            @if ($errors->get('bathrooms'))
            @foreach ($errors->get('bathrooms') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Stanze -->
        <div class="form-group mb-3 formcontainer flex-row">
            <div class="d-flex">
                <div class="col-2">
                    <label for="rooms" class="pt-2 @error('rooms') text-danger @enderror">Numero di stanze</label>
                </div>
                <input type="number" name="rooms" class="form-control w-25  @error('rooms') is-invalid @enderror" value="{{ old('rooms', $home->rooms) }}" required>
            </div>

            @if ($errors->get('rooms'))
            @foreach ($errors->get('rooms') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Metri quadrati (mq) -->
        <div class="form-group mb-3 formcontainer flex-row">
            <div class="d-flex">
                <div class="col-2">
                    <label for="square_metres" class="pt-2 @error('square_metres') text-danger @enderror">Metri quadri (mq)</label>
                </div>
                <input type="number" name="square_metres" class="form-control w-25  @error('square_metres') is-invalid @enderror" value="{{ old('square_metres', $home->square_metres) }}" required>
            </div>

            @if ($errors->get('square_metres'))
            @foreach ($errors->get('square_metres') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
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
            @if ($errors->has('services'))
            <div class="invalid-feedback d-block">
                @foreach ($errors->get('services') as $message)
                {{ $message }}<br>
                @endforeach
            </div>
            @endif
        </div>
        {{-- Immagini--}}

        <div class="mb-3 ">
            <label for="images" class="form-label">Immagini</label>
            <input type="file" class="form-control" id="images" name="image" multiple>
            @if ($errors->get('image'))
            @foreach ($errors->get('image') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>


        <div class="form-check mb-3">
            <input type="hidden" name="active" value="0">
            <input class="form-check-input" type="checkbox" name="active" id="active" value="1"
                {{ old('active', $home->active) == 1 ? 'checked' : '' }}>

            <label class="form-check-label" for="active"> Visibile </label>
        </div>


        <!-- Aggiornamento -->
        <button class="effect mb-3">Aggiorna</button>
    </form>

    @endsection