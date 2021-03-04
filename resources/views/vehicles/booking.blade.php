@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Demande de devis</h1>
            </div>
        </div>

        @include('layouts.includes.form-errors')
        <form method="POST" action="{{ route('vehicles.calcul') }}">
                <select class="form-control" name="vehicle_id">
                    <option value="">Séléctionner un vehicule</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{$vehicle->id}}">{{ $vehicle->name }}</option>
                    @endforeach
                </select>
                @csrf
                <div class="form-group">
                    <label for="">Date de début de la réservation</label>
                    <input  class="form-control" type="date" name="starting_at">
                </div>
                <div class="form-group">
                    <label for="">Date de fin de la réservation</label>
                    <input  class="form-control" type="date" name="ending_at">
                </div>
                <button type="submit" class="btn btn-primary">Demander un devis</button>
        </form>
@endsection
