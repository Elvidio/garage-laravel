@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Résumé du devis</h1>
            </div>
            <div class="col-lg-12">
                <p>Nom du véhicule : {{$vehicle->name}}</p>
            </div>
            <div class="col-lg-12">
                <p>Date du début de la location : {{$started}}</p><br>
                <p>Date du fin la location : {{$ended}}</p><br>
                <p>Durant : {{$days}} jours</p>
            </div>
            <div class="col-lg-12">
                <p>Prix HT : {{ $prixHT }} €</p>
            </div>
            <div class="col-lg-12">
                <p>Prix TTC :{{ $prixTTC }} €</p>
            </div>

        </div>

        @include('layouts.includes.form-errors')

@endsection
