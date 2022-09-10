@extends('layouts.master')

@section('title')
    Paiement des independants
@endsection

@section('style')
    
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Paiement des pigistes</h1>
        </div>

        <!-- DataTales Example -->
        @foreach ($pigistes as $pig)
            @foreach ($taches as $tache)
                @if ($tache->coll_id == $pig->id)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <div class="d-flex">
                                <div class="dropdown no-arrow mr-2">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item details" href="#collapseCardExample{{ $pig->id }}" data-toggle="collapse"
                                            role="button" aria-expanded="true" aria-controls="collapseCardExample">Voir les détails</a>
                                        <div class="dropdown-divider"></div>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')                                
                                            <button class="dropdown-item" type="submit">Supprimer pigiste</button>
                                        </form>
                                    </div>
                                </div>
                                <h6 class="m-0 font-weight-bold text-primary">{{ $pig->user->name.' '.$pig->user->prenom }}</h6>
                            </div>  
                            <div>
                                <span class="btn btn-primary text-xs">
                                    <span class="text">{{ $pig->compitance }}</span>
                                </span>
                            </div>         
                        </div>
                        <div class="card-body collapse" id="collapseCardExample{{ $pig->id }}">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tite d'article</th>
                                            <th>Date de fin</th>
                                            <th>Salariés (DH)</th>
                                            <th>statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">                                        
                                        <tr>
                                            <td>{{ $tache->article->title }}</td>
                                            <td> {{ $tache->end_date }} </td>
                                            <td> {{ $tache->prix }} </td>
                                            <td> 
                                                @if ($tache->status == 'payer')
                                                    <span class="badge badge-success"> {{ $tache->status}} </span>
                                                @else
                                                    <span class="badge badge-danger"> {{ $tache->status}} </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" style="font-size: 20px;" class="mr-md-4 d-md-inline-block d-block">
                                                    <i class="fas fa-donate"></i>
                                                </a>
                                                <a href="#" style="font-size: 20px;" class="d-inline-block mt-2">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach

    </div>
@endsection