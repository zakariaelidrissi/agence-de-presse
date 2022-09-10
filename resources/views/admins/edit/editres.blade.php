@extends('layouts.master')

@section('title')
    Edit un responsable
@endsection

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Modifier les information du responsable</h1>
        </div>
        <div class="card shadow mb-4">
        @foreach ($responsable as $res)
            <form method="POST" action="{{ route('gestion.responsables.update', $res->user_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')            
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-6 mb-4">
                            <label for="nom" class="form-label">Nom de responsable</label>
                            <input type="text" class="form-control modifie @error('nom') is-invalid @enderror" placeholder="Ajouter nom de responsable" id="nom" name="nom" value="{{ $res->user->name }}">
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="prenom" class="form-label">Prenom de responsable</label>
                            <input type="text" class="form-control modifie @error('prenom') is-invalid @enderror" placeholder="Ajouter prenom de responsable" id="prenom" name="prenom" value="{{ $res->user->prenom }}">
                            @error('prenom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6 mb-2">
                            <input type="text" class="form-control modifie @error('phone') is-invalid @enderror" placeholder="Téléphone" name="phone" value="{{ $res->user->phone }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 input-group mb-2">
                            <input type="datetime-local" class="form-control date modifie @error('birthday') is-invalid @enderror" placeholder="Date de naissance" name="birthday" value="{{ $res->user->birthday }}">
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
                            <label for="email" class="form-label">Email de responsable</label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="email" class="form-control modifie @error('email') is-invalid @enderror" placeholder="Exemple@email.com" id="email" name="email" value="{{ $res->user->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="salaire" class="form-label">Salarié de responsable</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('salaire') is-invalid @enderror" min="4000" placeholder="4000" id="salaire" name="salaire" value="{{ $res->salaire }}">
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
                            <input type="password" class="form-control @error('pass') is-invalid @enderror" placeholder="Password" id="password" name="pass">
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
                            <label class="form-label">Image du responsable </label>
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
                    <button class="btn btn-secondary" type="reset" >Reset</button>
                    <input type="submit" class="btn btn-primary" value="Update">            
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