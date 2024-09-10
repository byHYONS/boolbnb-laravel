@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Formulario di edizione -->
        <form action="{{ route('admin.homes.update', $home) }}" method="POST">
            @csrf
            @method('PUT')
    
            <!-- Titolo -->
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $home->title) }}" required>
            </div>
    
            <!-- Descrizione -->
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ old('description', $home->description) }}</textarea>
            </div>
    
            <!-- Letti -->
            <div class="form-group mb-3">
                <label for="beds">Beds</label>
                <input type="number" name="beds" class="form-control" value="{{ old('beds', $home->beds) }}" required>
            </div>
    
            <!-- Bagni -->
            <div class="form-group mb-3">
                <label for="bathrooms">Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control" value="{{ old('bathrooms', $home->bathrooms) }}" required>
            </div>
    
            <!-- Stanze -->
            <div class="form-group mb-3">
                <label for="rooms">Rooms</label>
                <input type="number" name="rooms" class="form-control" value="{{ old('rooms', $home->rooms) }}" required>
            </div>
    
            <!-- Mq -->
            <div class="form-group mb-3">
                <label for="mq">Metri quadrati (mq)</label>
                <input type="number" name="mq" class="form-control" value="{{ old('square_metres', $home->square_metres) }}" required>
            </div>
    
            <!-- Indirizzo -->
            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $home->address) }}" required>
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
            </div>
            {{-- Immagini --}}
            <div class="mb-3">
                <label for="images" class="form-label">Immagini</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
            </div>
        
    
            <!-- Botón de actualización -->
            <button  class="btn btn-primary my-3">Aggiorna</button>
        </form>

    </div>
@endsection