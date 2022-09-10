@extends('layouts.master')

@section('title')
    Edit un collaborateur
@endsection

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Modifier les information du collaborateur</h1>
        </div>
        <div class="card shadow mb-4">
        @foreach ($collaborateur as $coll)
            <form action="{{ route('gestion.collaborateurs.update', $coll->user_id) }}" method="POST" id="add_coll_form" enctype="multipart/form-data">
                @csrf
                @method('PUT')                
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
        @endforeach          
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