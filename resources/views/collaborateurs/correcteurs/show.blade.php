@extends('layouts.master')


@section('title')
    Show Tache Page
@endsection

@section('content')
    <div class="container">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Correction d'article</h1>
        </div>

        <div class="card shadow mb-4">
            @foreach ($article as $art)
                <form action="{{ route('correcteur.edit.tache', $art->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="titrArticle" class="form-label">Titre de l'article</label>
                                <input type="text" class="form-control" placeholder="Ajouter tite d'article" id="titrArticle" name="title" value="{{ $art->title }}">
                            </div>
                            <div class="form-group col-12 mb-3">
                                <label for="exampleFormControlTextarea1">Texte de l'article</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="body">
                                    {{ $art->body }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary" value="Corriger">
                    </div>
                </form>                
            @endforeach
        </div>

    </div>
@endsection