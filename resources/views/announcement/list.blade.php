@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1>Les annonces</h1>
                <a href="{{ route('announcement.add') }}" class="btn btn-primary">Ajouter une annonce</a>
            </div>
        </div>
        <div class="row">
                    @foreach($announcements as $announcement)
                        <div class="col-lg-3">
                            <div class="card mb-5" style="width: 18rem;">
                                <img class="card-img-top" src="https://picsum.photos/seed/picsum/300/200" alt="Card image cap">
                                <div class="card-body">
                                    <p><span>{{ $announcement->title}}</span>
                                    <p><span>{{ $announcement->content }}</span></p>
                                    <p>{{ $announcement->price }} €</p>
                                    <a href="{{ route('announcement.edit') }}" class="btn btn-primary">Éditer</a>
                                    <a href="{{ route('announcement.delete') }}" class="btn btn-primary">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection
