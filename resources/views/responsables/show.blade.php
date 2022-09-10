@extends('layouts.master')

@section('title')
    Collaborateurs Salaries
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Dropdown Card Example -->
        @foreach ($article as $art)
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <!-- sujet d'articl -->
                    <h6 class="m-0 font-weight-bold text-primary"> {{ $art->title }} </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">                            
                            <div class="badge badge-secondary mx-3"> {{ $status }} </div>
                            @if ($status !== 'valider')
                                <div class="dropdown-divider"></div>                            
                                {{-- <a class="dropdown-item" href="#">Valider</a> --}}
                                <form action="{{ route('res.valider.tache', $tache_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item"style="color: green;">                                        
                                        Valider
                                    </button>
                                </form>
                                {{-- <a class="dropdown-item" href="#">Non valider</a> --}}
                                <form action="{{ route('res.refuser.tache', $tache_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item"style="color: red;">                                        
                                        Refuser
                                    </button>
                                </form>
                            @endif
                            <div class="dropdown-divider"></div>
                            <!-- retourner vers page de nouveaux articles -->
                            <a class="dropdown-item" href="{{ route('articles.new') }}">retourner</a>                            
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body px-5">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <h1 class="h3 mb-5 text-gray-800 text-center"> {{ $art->title }} </h1>
                    <div class="col-12 col-md-10 mx-auto mb-5">
                        @if (!$art->photo)
                            <img src="{{ asset('storage/images/3hFSkPFkHVSh1q3d6CGjS9BHXAZHfxGxHf6pkBal.jpg') }}" width="100%" style="max-height: 400px;">
                        @else
                            <img src="{{ asset('storage/'.$art->photo) }}" width="100%" style="max-height: 400px;">
                        @endif
                    </div>
                    <div class="text-justify text-gray-800">
                        {{-- {{ $art->body }} --}}
                        {{ $tache->body }}
                    </div>
                </div>
            </div>            
        @endforeach

    </div>
@endsection