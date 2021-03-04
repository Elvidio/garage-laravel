@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Ajouter une annonce</h1>
            </div>
        </div>

        @include('layouts.includes.form-errors')

        <div class="row">
            <div class="col-lg-6">
                <form method="POST" action="{{ route('announcement.store') }}">
                    <div class="form-group">
                        <label for="">Titre de l'annonce</label>
                        <input  class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Contenu de l'annonce</label>
                        <input class="form-control" type="text" name="content">
                    </div>
                    <div class="form-group">
                        <label for="">Prix de l'annonce</label>
                        <input class="form-control" type="text" name="price">
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary">Creer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
