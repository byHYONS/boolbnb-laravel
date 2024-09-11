@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Formulario di edizione -->
    <form action="{{ route('admin.homes.update', $home) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')

        <!-- Titolo -->
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control @if ($errors->get('title')) is-invalid @endif" value="{{ old('title', $home->title) }}">
            @if ($errors->get('title'))
            @foreach ($errors->get('title') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Descrizione -->
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control @if ($errors->get('description')) is-invalid @endif">{{ old('description', $home->description) }}</textarea>
            @if ($errors->get('description'))
            @foreach ($errors->get('description') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Letti -->
        <div class="form-group mb-3">
            <label for="beds">Beds</label>
            <input type="number" name="beds" class="form-control @if ($errors->get('beds')) is-invalid @endif" value="{{ old('beds', $home->beds) }}">
            @if ($errors->get('beds'))
            @foreach ($errors->get('beds') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Bagni -->
        <div class="form-group mb-3">
            <label for="bathrooms">Bathrooms</label>
            <input type="number" name="bathrooms" class="form-control @if ($errors->get('bathrooms')) is-invalid @endif" value="{{ old('bathrooms', $home->bathrooms) }}">
            @if ($errors->get('bathrooms'))
            @foreach ($errors->get('bathrooms') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Stanze -->
        <div class="form-group mb-3">
            <label for="rooms">Rooms</label>
            <input type="number" name="rooms" class="form-control @if ($errors->get('rooms')) is-invalid @endif" value="{{ old('rooms', $home->rooms) }}">
            @if ($errors->get('rooms'))
            @foreach ($errors->get('rooms') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Mq -->
        <div class="form-group mb-3">
            <label for="mq">Metri quadrati (mq)</label>
            <input type="number" name="square_metres" class="form-control @if ($errors->get('square_metres')) is-invalid @endif" value="{{ old('square_metres', $home->square_metres) }}">
            @if ($errors->get('square_metres'))
            @foreach ($errors->get('square_metres') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Indirizzo -->
        <div class="form-group mb-3">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control @if ($errors->get('address')) is-invalid @endif" value="{{ old('address', $home->address) }}">
            @if ($errors->get('address'))
            @foreach ($errors->get('address') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <!-- Servizi -->
        <div class="form-group mb-3">
            <label for="services">Services</label>
            <div>
                @foreach ($services as $service)
                <div class="form-check">
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
        {{-- Immagini --}}
        <div class="mb-3">
            <label for="image" class="form-label">Immagini</label>
            <input type="file" class="form-control @if ($errors->get('image')) is-invalid @endif" id="image" name="image">
            @if ($errors->get('image'))
            @foreach ($errors->get('image') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>


        <!-- Botón de actualización -->
        <button class="btn btn-primary my-3">Aggiorna</button>
    </form>

</div>
@endsection