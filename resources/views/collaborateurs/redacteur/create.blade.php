@extends('layouts.master')

@section('title')
    Les Nouveaux Articles
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rédaction d'article</h1>
        </div>

        <div class="card shadow mb-4">
            <form action="{{ route('red.store.article', $article_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="titrArticle" class="form-label">Titre de l'article</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Ajouter tite d'article" id="titrArticle" name="title" value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image de l'article</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile01" name="image">
                                <label class="custom-file-label" for="inputGroupFile01">Choisir image</label>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12 mb-3">
                            <label for="exampleFormControlTextarea1">Texte de l'article</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" id="exampleFormControlTextarea1" rows="10" name="body">
                                {{ old('body') }}
                            </textarea>
                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <input type="submit" class="btn btn-primary" value="Ajouter">
                </div>
            </form>            
        </div>        
    </div>
@endsection