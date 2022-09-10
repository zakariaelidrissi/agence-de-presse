@extends('layouts.master')

@section('title')
    Gestion des collaborateurs
@endsection

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading 2 -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gestion des employés</h1>
        </div>                        
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <!-- Page body 1 -->
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#ajouterEmploye">
                    <span class="text font-weight-bold">Ajouter employés</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">                    
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Poste</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collaborateur as $coll)
                                <tr>
                                    @if ($coll->user->photo)
                                        <td class="text-center">
                                            <img class="img-profile rounded-circle" style="width: 40px;"
                                            src="{{ asset('storage/'.$coll->user->photo) }}">
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <img class="img-profile rounded-circle" style="width: 40px;"
                                            src="{{ asset('img/undraw_profile.svg') }}">
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $coll->user->name.' '.$coll->user->prenom }}</td>
                                    <td class="align-middle">{{ $coll->compitance }}</td>
                                    <td class="align-middle">{{ $coll->user->email }}</td>
                                    <td class="align-middle">{{ $coll->user->phone }}</td>
                                    <td class="text-center">
                                        {{-- <a href="{{ route('gestion.collaborateurs.edit', $coll->user_id) }}" style="font-size: 20px;" class="mr-md-4 d-md-inline-block d-block editIcon">
                                            <i class="fas fa-edit"></i>
                                        </a> --}}
                                        <a href="#" style="font-size: 20px;" class="mr-md-4 d-md-inline-block d-block" data-toggle="modal" data-target="#modifieEmploye{{ $coll->user_id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" style="font-size: 20px;color: red;" class="d-inline-block mt-2" data-toggle="modal" data-target="#suppModal{{ $coll->user_id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>                                        
                                    </td>
                                </tr>
                                <!-- Confirmation Modal-->
                                <div class="modal fade" id="suppModal{{ $coll->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Êtes-vous sûr d'avoir supprimé cette collaborateur?</div>
                                            <form action="{{ route('gestion.collaborateurs.delete', $coll->user_id  ) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-footer">                                                    
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Non</button>                                                    
                                                    <button class="btn btn-primary" type="submit">Oui</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modifie employes Modal-->
                                <div class="modal fade" id="modifieEmploye{{ $coll->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('gestion.collaborateurs.update', $coll->user_id) }}" method="POST" id="add_coll_form" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modifié les information du collaborateur</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>                
                                                <div class="modal-body">
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            @if ($coll->compitance == 'redacteur')
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="customRadioInline0" name="customRadioInline1" class="custom-control-input" value="redacteur" checked>
                                                                    <label class="custom-control-label" for="customRadioInline0">Rédaction</label>
                                                                </div>
                                                            @else
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="customRadioInline0" name="customRadioInline1" class="custom-control-input" value="redacteur">
                                                                    <label class="custom-control-label" for="customRadioInline0">Rédaction</label>
                                                                </div>                      
                                                            @endif
                                                            @if ($coll->compitance == 'correcteur')
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="correcteur" checked>
                                                                    <label class="custom-control-label" for="customRadioInline1">Correction</label>
                                                                </div>
                                                            @else
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="correcteur">
                                                                    <label class="custom-control-label" for="customRadioInline1">Correction</label>
                                                                </div>
                                                            @endif
                                                            @if ($coll->compitance == 'traducteur')
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="traducteur" checked>
                                                                    <label class="custom-control-label" for="customRadioInline2">Traduction</label>
                                                                </div>
                                                            @else
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="traducteur">
                                                                    <label class="custom-control-label" for="customRadioInline2">Traduction</label>
                                                                </div>
                                                            @endif                            
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="nom" class="form-label">Nom d'employé</label>
                                                            <input type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Ajouter nom d'employé" id="nom" name="nom" value="{{ $coll->user->name }}">
                                                            @error('nom')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="prenom" class="form-label">Prenom d'employé</label>
                                                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="Ajouter prenom d'employé" id="prenom" name="prenom" value="{{ $coll->user->prenom }}">
                                                            @error('prenom')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6 mb-2">
                                                            <input class="form-control @error('phone') is-invalid @enderror" type="text" placeholder="Téléphone" name="phone" value="{{ $coll->user->phone }}">
                                                            @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-6 input-group mb-2">
                                                            <input class="form-control date @error('birthday') is-invalid @enderror" type="datetime-local" placeholder="Date de naissance" name="birthday" value="{{ $coll->user->birthday }}">
                                                            <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                                            @error('birthday')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="email" class="form-label">Email d'employé</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">@</span>
                                                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Exemple@email.com" id="email" name="email" value="{{ $coll->user->email }}">
                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label for="salarie" class="form-label">Salarié d'employé</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control @error('salaire') is-invalid @enderror" min="3000" max="7000" placeholder="3000" id="salarie" name="salaire" value="{{ $coll->salaire }}">
                                                                <span class="input-group-text">DH</span>
                                                                @error('salaire')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="password" class="form-label">Mot de passe</label>
                                                            <input type="password" class="form-control @error('pass') is-invalid @enderror" placeholder="Password" id="password" name="pass" >
                                                            @error('pass')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label for="confPassword" class="form-label">Confirmation du mot de passe</label>
                                                            <input type="password" class="form-control" placeholder="Password" id="confPassword" name="confpass">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Image du collaborateur </label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="formFile" name="image">
                                                                <label class="custom-file-label" for="formFile">Choisir image</label>
                                                                @error('image')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>                            
                                                    </div>
                                
                                                </div>
                                                <div class="modal-footer">                    
                                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                                    <input type="submit" class="btn btn-primary" value="Update" id="add_coll_btn">                    
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div>                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- ajouter employes Modal-->
    {{-- <div class="modal fade" id="ajouterEmploye" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">                
                <form action="{{ route('gestion.collaborateurs.store') }}" method="POST" id="add_coll_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un employé</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline0" name="customRadioInline1" class="custom-control-input" value="redacteur" checked>
                                    <label class="custom-control-label" for="customRadioInline0">Rédaction</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="correcteur">
                                    <label class="custom-control-label" for="customRadioInline1">Correction</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="traducteur">
                                    <label class="custom-control-label" for="customRadioInline2">Traduction</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-4">
                                <label for="nom" class="form-label">Nom d'employé</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Ajouter nom d'employé" id="nom" name="nom" value="{{ old('nom') }}">
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prenom d'employé</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="Ajouter prenom d'employé" id="prenom" name="prenom" value="{{ old('prenom') }}">
                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6 mb-2">
                                <input class="form-control @error('phone') is-invalid @enderror" type="text" placeholder="Téléphone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 input-group mb-2">
                                <input class="form-control date @error('birthday') is-invalid @enderror" type="datetime-local" placeholder="Date de naissance" name="birthday" value="{{ old('birthday') }}">
                                <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label">Email d'employé</label>
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Exemple@email.com" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="salarie" class="form-label">Salarié d'employé</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('salaire') is-invalid @enderror" min="3000" max="7000" placeholder="3000" id="salarie" name="salaire" value="{{ old('salaire') }}">
                                    <span class="input-group-text">DH</span>
                                    @error('salaire')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('pass') is-invalid @enderror" placeholder="Password" id="password" name="pass" >
                                @error('pass')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="confPassword" class="form-label">Confirmation du mot de passe</label>
                                <input type="password" class="form-control" placeholder="Password" id="confPassword" name="confpass">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">                                                             
                                <label for="themeColl" class="form-label">Choisir le thème</label>
                                <select class="form-control" id="themeColl" required name="theme">
                                    <option value="">Choisir le thème</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->categorie }}"> {{ $cat->categorie }}</option>                                        
                                    @endforeach
                                </select>                                    
                                @error('theme')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                                
                            </div>                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Image du collaborateur </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="formFile" name="image">
                                    <label class="custom-file-label" for="formFile">Choisir image</label>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="reset" data-dismiss="modal">Close</button>
                        <input type="reset" class="btn btn-secondary" value="Reset">
                        <input type="submit" class="btn btn-primary" value="Add" id="add_coll_btn">                    
                    </div>
                </form> 
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="ajouterEmploye" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">                
                <form action="{{ route('gestion.collaborateurs.store') }}" method="POST" id="add_coll_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un employé</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>                    
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline0" name="customRadioInline1" class="custom-control-input" value="redacteur" checked>
                                    <label class="custom-control-label" for="customRadioInline0">Rédaction</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="correcteur">
                                    <label class="custom-control-label" for="customRadioInline1">Correction</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="traducteur">
                                    <label class="custom-control-label" for="customRadioInline2">Traduction</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-4">
                                <label for="nom" class="form-label">Nom d'employé</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Ajouter nom d'employé" id="nom" name="nom" value="{{ old('nom') }}">
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prenom d'employé</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="Ajouter prenom d'employé" id="prenom" name="prenom" value="{{ old('prenom') }}">
                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6 mb-2">
                                <input class="form-control @error('phone') is-invalid @enderror" type="text" placeholder="Téléphone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 input-group mb-2">
                                <input class="form-control date @error('birthday') is-invalid @enderror" type="datetime-local" placeholder="Date de naissance" name="birthday" value="{{ old('birthday') }}">
                                <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label">Email d'employé</label>
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Exemple@email.com" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="salarie" class="form-label">Salarié d'employé</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('salaire') is-invalid @enderror" min="3000" max="7000" placeholder="3000" id="salarie" name="salaire" value="{{ old('salaire') }}">
                                    <span class="input-group-text">DH</span>
                                    @error('salaire')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('pass') is-invalid @enderror" placeholder="Password" id="password" name="pass" >
                                @error('pass')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="confPassword" class="form-label">Confirmation du mot de passe</label>
                                <input type="password" class="form-control" placeholder="Password" id="confPassword" name="confpass">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">                                                             
                                <label for="themeColl" class="form-label">Choisir le thème</label>
                                <select class="form-control" id="themeColl" required name="theme">
                                    <option value="">Choisir le thème</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->categorie }}"> {{ $cat->categorie }}</option>                                        
                                    @endforeach
                                </select>                                    
                                @error('theme')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                                
                            </div> 
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Image du collaborateur </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="formFile" name="image">
                                    <label class="custom-file-label" for="formFile">Choisir image</label>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="reset" data-dismiss="modal">Close</button>
                        <input type="reset" class="btn btn-secondary" value="Reset">
                        <input type="submit" class="btn btn-primary" value="Add" id="add_coll_btn">                    
                    </div>
                </form> 
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('js/app/js') }}"></script>
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
