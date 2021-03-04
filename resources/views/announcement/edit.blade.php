@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Modifier une annonce</h1>
            </div>
        </div>

        @include('layouts.includes.form-errors')

        <div class="row">
            <div class="col-lg-6">
                <form method="POST" action="{{ route('announcement.edited') }}">
                    <div class="form-group">
                        <label for="">Modifier le titre votre l'annonce</label>
                        <input  class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Modifier le contenu votre l'annonce</label>
                        <input class="form-control" type="text" name="content">
                    </div>
                    <div class="form-group">
                        <label for="">Modifier le prix votre l'annonce</label>
                        <input class="form-control" type="text" name="price">
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary">Creer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
