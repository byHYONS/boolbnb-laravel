@extends('layouts.app')
@section('content')
    {{-- <div class="welcome">
        <div class="jumbotron p-5 mb-4 bg-light rounded-3">
            <div class="container py-5">
    
                <h1 class="display-5 fw-bold">
                    Welcome to Laravel+Bootstrap
                </h1>
    
                <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in
                    previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your
                    liking.</p>
                <button class="button" type="button">Example button</button>
            </div>
        </div>
    
        <div class="content">
            <div class="container">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi
                    deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis
                    accusamus dolores!</p>
            </div>
        </div>
    </div> --}}

    <section id="welcome">
        <div class="home-show">
            <div class="bg01">
                <div class="container py-75">
                    <div class="headline ">
                        <h1>
                            La <span>Tua Casa </span>Merita di Essere Vista! 
                            <br> 
                            Pubblica il Tuo Annuncio su <span>BoolBnb</span> e Ottieni il <span>Massimo</span> della Visibilità!
                        </h1>
                    </div>
                </div>
            </div>
            <div class="subheadline">
                <div class="container mt-75">
                    <p>
                        Pubblica il tuo annuncio su BoolBnb e assicurati che la tua casa sia vista da migliaia di potenziali acquirenti! 
                    </p>
                    <p>
                        Con le nostre sponsorizzazioni Platinum, Gold e Silver, hai la possibilità di apparire in cima ai risultati di ricerca e ottenere una visibilità mirata e strategica. 
                    </p> 
                    <h3 class="mt-4"> 
                        Non aspettare <span>scegli BoolBnb</span> per dare al tuo immobile l’<span>attenzione che merita</span>
                    </h3>
                    <div class="manage">
                        <div class="create py-5">
                            <a href="{{route('admin.homes.create') }}">{{ __('Crea Nuovo')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection