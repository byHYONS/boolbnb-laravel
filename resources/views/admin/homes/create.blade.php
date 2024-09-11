@extends('layouts.app')

@section('content')
<div class="container">
    
        <h2 class="m-3">Affitta un appartamento</h2>
        
        <div class="button-manage">
                {{--? bottone indietro --}}
                <div class="back">
                    <a href="{{route('admin.homes.index') }}">{{ __('Indietro')}}</a>              
                </div>
        <!-- <a href="{{route('admin.homes.index') }}"><button class="back">torna alla home</button></a> -->

    

    <form action="{{route('admin.homes.store')}}" method="POST" enctype="multipart/form-data" class="m-3">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @if ($errors->get('title')) is-invalid @endif" id="title" name="title" value="{{old('title')}}">
            @if ($errors->get('title'))
            @foreach ($errors->get('title') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @if ($errors->get('description')) is-invalid @endif" id="description" rows="3" name="description">{{old('description')}}</textarea>
            @if ($errors->get('description'))
            @foreach ($errors->get('description') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="text" class="form-control @if ($errors->get('address')) is-invalid @endif" id="address" name="address" value="{{old('address')}}">
            @if ($errors->get('address'))
            @foreach ($errors->get('address') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="mb-3">
            <div class="d-flex">
                <div class="col-2">
                    <label for="num-beds" class="form-label me-4">Numero di letti</label>
                </div>
                <input type="number" class="w-25 form-control @if ($errors->get('beds')) is-invalid @endif" id="num-beds" name="beds" value="{{old('beds')}}">
            </div>
            @if ($errors->get('beds'))
            @foreach ($errors->get('beds') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="mb-3">
            <div class="d-flex">
                <div class="col-2">
                    <label for="num-bathrooms" class="form-label me-4">Numero di bagni</label>
                </div>
                <input type="number" class="w-25 form-control @if ($errors->get('bathrooms')) is-invalid @endif" id="num-bathrooms" name="bathrooms" value="{{old('bathrooms')}}">
            </div>
            @if ($errors->get('bathrooms'))
            @foreach ($errors->get('bathrooms') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="mb-3">
            <div class="d-flex">
                <div class="col-2">
                    <label for="num-rooms" class="form-label me-4">Numero di stanze</label>
                </div>
                <input type="number" class="w-25 form-control @if ($errors->get('rooms')) is-invalid @endif" id="num-rooms" name="rooms" value="{{old('rooms')}}">
            </div>
            @if ($errors->get('rooms'))
            @foreach ($errors->get('rooms') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="mb-3">
            <div class="d-flex">
                <div class="col-2">
                    <label for="num-mq" class="form-label me-4">Metri quadri</label>
                </div>
                <input type="number" class="w-25 form-control @if ($errors->get('square_metres')) is-invalid @endif" id="num-mq" name="square_metres" value="{{old('square_metres')}}">
            </div>
            @if ($errors->get('square_metres'))
            @foreach ($errors->get('square_metres') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="mb-3">
            <label for="services" class="form-label">Servizi</label>
            <div class="d-flex flex-wrap">
                @foreach ($services as $service)
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="service-{{$service->id}}" value="{{$service->id}}" name="services[]" {{in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="service-{{$service->id}}">{{$service->name}}</label>
                    </div>
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

        <div class="mb-3">
            <label for="image" class="form-label">Cover image</label>
            <input class="form-control @if ($errors->get('image')) is-invalid @endif" type="file" name="image" id="image">
            @if ($errors->get('image'))
            @foreach ($errors->get('image') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="active" id="active" value="1">
            <label class="form-check-label" for="active"> Visibile </label>
        </div>

        <button class="btn btn-outline-secondary">Affitta</button>
    </form>
</div>
@endsection