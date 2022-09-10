@extends('layouts.master')

@section('title')
    New Articles
@endsection

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        #dataTable_wrapper .row:first-child, #dataTable_wrapper .row:last-child {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Nouveaux articles</h1>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-success">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <!-- add article -->
                <div>
                    <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#ajouterArticle">
                        <span class="text font-weight-bold">Ajouter article</span>
                    </a>
                </div>
                
                <!-- add catégorie -->
                <form action="{{ route('create.categorie') }}" method="POST" class="d-none d-md-inline-block mw-100">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Ajouter catégorie" aria-label="Search"
                            aria-describedby="basic-addon2" name="categorie">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <a class="d-md-none" title="Ajouter Catégorie" href="#" data-toggle="modal" data-target="#addCateModal">
                    <i class="fas fa-plus-square fa-2x"></i>
                </a>
            </div>
        </div>

        <!-- DataTales Example -->
        @foreach ($articles as $article)
            <div class="card shadow mb-4">            
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="d-flex">
                        <div class="dropdown no-arrow mr-2">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ajouterSalarie{{ $article->id }}">Ajouter salarié</a> --}}
                                @if (!$article->redacteur_id)
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ajouterRedacteur{{ $article->id }}">Ajouter Redacteur</a>
                                @endif                                
                                @if (!$article->correcteur_id && $article->redacteur_id)
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ajouterCorrecteur{{ $article->id }}">Ajouter Correcteur</a>
                                @endif
                                {{-- && $article->tache->status == 'valider' --}}
                                @if (!$article->traducteur_id && $article->correcteur_id)
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ajouterTraducteur{{ $article->id }}">Ajouter Traducteur</a>
                                @endif
                                {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ajouterPigiste{{ $article->id }}">Ajouter pigiste</a> --}}
                                <a class="dropdown-item" href="#collapseCardExample{{ $article->id }}" data-toggle="collapse"
                                role="button" aria-expanded="true" aria-controls="collapseCardExample">Voir detail</a>
                                @if ($article->correcteur_id && $article->etat !== 'publie')
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('publie.article', $article->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="dropdown-item"style="color: blue;">                                        
                                            Publie l'article
                                        </button>
                                    </form>                                    
                                @endif
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('delete.article', $article->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item"style="color: red;">                                        
                                        Supprimer article
                                    </button>
                                </form>
                            </div>
                        </div>
                        <h6 class="m-0 font-weight-bold text-primary">{{ $article->title }}</h6>
                    </div>
                    <div>
                        <span class="btn btn-primary text-xs">
                            <span class="text">{{ $article->categorie }}</span>
                        </span>
                    </div>
                </div>
                <div class="card-body collapse" id="collapseCardExample{{ $article->id }}">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Nom</th>
                                    <th>Date de début</th>
                                    <th>Date limite</th>
                                    <th>statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($article->taches as $tache)                                                                        
                                    @foreach ($collaborateur as $coll)
                                        @if ($coll->id == $tache->coll_id && $tache->article_id == $article->id )
                                            <tr>
                                                <td>{{ $coll->compitance }}</td>
                                                <td>{{ $coll->user->name.' '.$coll->user->prenom }}</td>
                                                <td>{{ $tache->start_date }}</td>
                                                <td>{{ $tache->end_date }}</td>
                                                <td> 
                                                    @if($tache->status == 'pas encore' || $tache->status == 'refuser') 
                                                        <span class="badge badge-danger"> {{ $tache->status }} </span> 
                                                    @endif
                                                    @if($tache->status == 'encore') 
                                                        <span class="badge badge-secondary"> {{ $tache->status }} </span> 
                                                    @endif
                                                    @if($tache->status == 'finie') 
                                                        <span class="badge badge-info"> {{ $tache->status }} </span> 
                                                    @endif
                                                    @if($tache->status == 'valider') 
                                                        <span class="badge badge-success"> {{ $tache->status }} </span> 
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('res.show.tache', $tache->id) }}" style="font-size: 20px;" class="mr-4 d-md-inline-block">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" style="font-size: 20px;" class="d-md-inline-block">
                                                        <i class="fas fa-edit"></i>
                                                    </a>                                                    
                                                </td>
                                            </tr>                                            
                                        @endif    
                                    @endforeach                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Ajouter tache redacteur Modal -->
            <div class="modal fade" id="ajouterRedacteur{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('add.tache.redacteur', $article->id) }}" method="POST">
                            @csrf                            
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">                                
                                <div class="row mb-1">
                                    <div class="col-12 mb-4">
                                        <label for="personne" class="form-label">Rédacteur</label>
                                        <select class="form-control" id="personne" required name="coll">
                                            <option class="role" value="">Ajouter Radacteur</option>
                                            @if (!$article->redacteur_id)
                                                <optgroup label="Radacteur Salarie">
                                                    @foreach ($collaborateur as $red)
                                                        @if ($red->is_freelancer == 0 && $red->compitance == 'redacteur' && $red->theme == $article->categorie && $red->disponible == 'oui')
                                                            <option value="{{ $red->id }}">{{ $red->user->name.' '.$red->user->prenom.' | '.$red->compitance.' - '.$red->score.'%' }}</option>
                                                        @endif
                                                    @endforeach                                                    
                                                </optgroup>
                                                <optgroup label="Radacteur Pigiste">
                                                    @foreach ($collaborateur as $red)
                                                        @if ($red->is_freelancer == 1 && $red->compitance == 'redacteur' && $red->theme == $article->categorie && $red->disponible == 'oui')
                                                            <option value="{{ $red->id }}">{{ $red->user->name.' '.$red->user->prenom.' | '.$red->compitance.' - '.$red->score.'%' }}</option>
                                                        @endif
                                                    @endforeach                                                
                                                </optgroup>
                                            @endif
                                        </select>
                                        @error('coll')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-sm-6 input-group mb-2">
                                        <input class="form-control date role" type="datetime-local" placeholder="Date début" name="start_date" value="{{ old('start_date') }}">
                                        <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                        @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    {{-- {{  now(); }} --}}
                                    <div class="col-sm-12 col-12 mb-4 input-group">
                                        <input class="form-control date role" type="datetime-local" placeholder="Date limite" name="end_date" value="{{ old('end_date') }}">
                                        <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                        @error('end_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="reset" data-dismiss="modal">Fermer</button>
                                <input type="reset" class="btn btn-secondary">
                                <input type="submit" class="btn btn-primary" value="Ajouter">                            
                            </div>
                        </form> 
                    </div>
                </div>
            </div>

            <!-- Ajouter tache correcteur Modal -->
            <div class="modal fade" id="ajouterCorrecteur{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('add.tache.correcteur', $article->id) }}" method="POST">
                            @csrf                            
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">                                
                                <div class="row mb-1">
                                    <div class="col-12 mb-4">
                                        <label for="personne" class="form-label">Correcteur</label>
                                        <select class="form-control" id="personne" required name="coll">
                                            <option class="role" value="">Ajouter Correcteur</option>
                                            @if (!$article->correcteur_id)
                                                
                                                <optgroup label="Correcteur Salarie">
                                                    @foreach ($collaborateur as $cor)
                                                        @if ($cor->is_freelancer == 0 && $cor->compitance == 'correcteur' && $cor->theme == $article->categorie && $cor->disponible == 'oui')
                                                            <option value="{{ $cor->id }}">{{ $cor->user->name.' '.$cor->user->prenom.' | '.$cor->compitance.' - '.$cor->score.'%' }}</option>
                                                        @endif
                                                    @endforeach                                               
                                                </optgroup>
                                                <optgroup label="Correcteur Pigiste">
                                                    @foreach ($collaborateur as $cor)
                                                        @if ($cor->is_freelancer == 1 && $cor->compitance == 'correcteur' && $cor->theme == $article->categorie && $cor->disponible == 'oui')
                                                            <option value="{{ $cor->id }}">{{ $cor->user->name.' '.$cor->user->prenom.' | '.$cor->compitance.' - '.$cor->score.'%' }}</option>
                                                        @endif
                                                    @endforeach                                                
                                                </optgroup>
                                            @endif                                       
                                        </select>
                                        @error('coll')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 input-group mb-2">
                                        <input class="form-control date role" type="datetime-local" placeholder="Date début" name="start_date" value="{{ old('start_date') }}">
                                        <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                        @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 input-group mb-2">
                                        <input class="form-control date role" type="datetime-local" placeholder="Date limite" name="end_date" value="{{ old('end_date') }}">
                                        <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                        @error('end_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="reset" data-dismiss="modal">Fermer</button>
                                <input type="reset" class="btn btn-secondary">
                                <input type="submit" class="btn btn-primary" value="Ajouter">                            
                            </div>
                        </form> 
                    </div>
                </div>
            </div>

            <!-- Ajouter tache traducteur Modal -->
            <div class="modal fade" id="ajouterTraducteur{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('add.tache.traducteur', $article->id) }}" method="POST">
                            @csrf                            
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">                                
                                <div class="row mb-1">
                                    <div class="col-12 mb-4">
                                        <label for="personne" class="form-label">Traducteur</label>
                                        <select class="form-control" id="personne" required name="coll">
                                            <option class="role" value="">Ajouter Traducteur</option>
                                            @if (!$article->traducteur_id)                                                
                                                <optgroup label="Traducteur Salarie">
                                                    @foreach ($collaborateur as $trad)
                                                        @if ($trad->is_freelancer == 0 && $trad->compitance == 'traducteur' && $trad->theme == $article->categorie && $trad->disponible == 'oui')
                                                            <option value="{{ $trad->id }}">{{ $trad->user->name.' '.$trad->user->prenom.' | '.$trad->compitance.' - '.$trad->score.'%' }}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Traducteur Pigiste">
                                                    @foreach ($collaborateur as $trad)
                                                        @if ($trad->is_freelancer == 1 && $trad->compitance == 'traducteur' && $trad->theme == $article->categorie && $trad->disponible == 'oui')
                                                            <option value="{{ $trad->id }}">{{ $trad->user->name.' '.$trad->user->prenom.' | '.$trad->compitance.' - '.$trad->score.'%' }}</option>
                                                        @endif
                                                    @endforeach                                               
                                                </optgroup>
                                            @endif
                                        </select>
                                        @error('coll')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 input-group mb-2">
                                        <input class="form-control date role" type="datetime-local" placeholder="Date début" name="start_date" value="{{ old('start_date') }}">
                                        <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                        @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 input-group mb-2">
                                        <input class="form-control date role" type="datetime-local" placeholder="Date limite" name="end_date" value="{{ old('end_date') }}">
                                        <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                        @error('end_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="reset" data-dismiss="modal">Fermer</button>
                                <input type="reset" class="btn btn-secondary">
                                <input type="submit" class="btn btn-primary" value="Ajouter">                            
                            </div>
                        </form> 
                    </div>
                </div>
            </div>

            <!-- Ajouter tache pigiste Modal -->
            <div class="modal fade" id="ajouterPigiste{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('add.pig.article', $article->id) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h6 class="mb-2  font-weight-bold text-primary role">Poste :</h6>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">                                        
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline00" name="customRadioInline2" value="redacteur" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="customRadioInline00">Rédaction</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline01" name="customRadioInline2" value="correcteur" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline01">Correction</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline02" name="customRadioInline2" value="traducteur" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline02">Traduction</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-6 input-group mb-2">
                                        <input class="form-control date role" type="datetime-local" placeholder="Date début" name="start_date" value="{{ old('start_date') }}">
                                        <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                    </div>
                                    <div class="col-sm-6 input-group mb-2">
                                        <input class="form-control date role" type="datetime-local" placeholder="Date limite" name="end_date" value="{{ old('end_date') }}">
                                        <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="personne" class="form-label">Rédacteur</label>
                                        <select class="form-control" id="personne" required name="pig">
                                            <option class="role" value="">Ajouter pigiste d'article</option>                                                                                        
                                            @if (!$article->redacteur_id)
                                                @foreach ($collaborateur as $red)
                                                    @if ($red->is_freelancer == 1 && $red->compitance == 'redacteur')
                                                        <option value="{{ $red->id }}">{{ $red->user->name.' '.$red->user->prenom.' | '.$red->compitance.' - '.$red->score.'%' }}</option>
                                                    @endif
                                                @endforeach
                                            @endif                                            
                                            <hr class="sidebar-divider mt-0">                                            
                                            @if (!$article->correcteur_id)
                                                @foreach ($collaborateur as $cor)
                                                    @if ($cor->is_freelancer == 1 && $cor->compitance == 'correcteur')
                                                        <option value="{{ $cor->id }}">{{ $cor->user->name.' '.$cor->user->prenom.' | '.$cor->compitance.' - '.$cor->score.'%' }}</option>                                                    
                                                    @endif
                                                @endforeach
                                            @endif                                            
                                            <hr class="sidebar-divider mt-0">                                            
                                            @if (!$article->traducteur_id)
                                                @foreach ($collaborateur as $trad)
                                                    @if ($trad->is_freelancer == 1 && $trad->compitance == 'traducteur')
                                                        <option value="{{ $trad->id }}">{{ $trad->user->name.' '.$trad->user->prenom.' | '.$trad->compitance.' - '.$trad->score.'%' }}</option>                                                    
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="salarie" class="form-label">prix de Tache</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="salarie" name="salaire" value="{{ old('salaire') }}">
                                            <span class="input-group-text">DH</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="reset" data-dismiss="modal">Fermer</button>
                                <input type="reset" class="btn btn-secondary">
                                <input type="submit" class="btn btn-primary" value="Ajouter">
                            
                            </div>
                        </form> 
                    </div>
                </div>
            </div>            
        @endforeach

    </div>

    <!-- Ajouter Article Modal -->
    <div class="modal fade" id="ajouterArticle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('create.article') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un Article</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <div class="col-md-8 mb-4">
                            <label for="categorieArticle" class="form-label">Catégorie</label>
                            <select class="form-control" id="categorieArticle" required name="categorie">
                                <option value="">Ajouter catégorie d'article</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->categorie }}"> {{ $cat->categorie }}</option>                                        
                                @endforeach
                            </select>
                            @error('categorie')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12 mb-3">
                            <label for="exampleFormControlTextarea1">sujet</label>
                            <textarea class="form-control @error('title') is-invalid @enderror" id="titrArticle" rows="3" name="title">                                
                            </textarea>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="reset" data-dismiss="modal">Fermer</button>
                        <input type="reset" class="btn btn-secondary">
                        <input type="submit" class="btn btn-primary" value="Ajouter">                    
                    </div>
                </form> 
            </div>
        </div>
    </div>    

    <!-- add -->
    <div class="modal fade" id="addCateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body ">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Ajouter catégorie" aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-plus fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
                    enableTime: false,
                    altInput: true,                    
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                }
        flatpickr(".date", config);
    </script>
@endsection