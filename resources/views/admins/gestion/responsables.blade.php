@extends('layouts.master')

@section('title')
    Gestion des responsables
@endsection

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Les responsables</h1>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- ajouter responsable -->
                <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#ajouterResponsable">
                    <span class="text font-weight-bold">Ajouter responsable</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Date de début</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach ($responsables as $res)                                                                                                                                
                                <tr>
                                    @if ($res->user->photo)
                                        <td class="text-center">
                                            <img class="img-profile rounded-circle" style="width: 40px;" src="{{ asset('storage/'.$res->user->photo) }}">
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <img class="img-profile rounded-circle" style="width: 40px;" src="{{ asset('img/undraw_profile.svg') }}">
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $res->user->name.' '.$res->user->prenom }}</td>
                                    <td class="align-middle">{{ $res->user->created_at }}</td>
                                    <td class="align-middle">{{ $res->user->email }}</td>
                                    <td class="align-middle">{{ $res->user->phone }}</td>
                                    <td class="text-center">                                                                                
                                        {{-- <a href="{{ route('gestion.responsables.edit', $res->user_id) }}" style="font-size: 20px;" class="mr-md-4 d-md-inline-block d-block" >
                                            <i class="fas fa-edit"></i>
                                        </a> --}}
                                        <a href="#" style="font-size: 20px;" class="mr-md-4 d-md-inline-block d-block" data-toggle="modal" data-target="#modifieResponsable{{ $res->user_id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" style="font-size: 20px;color: red;" class="d-inline-block mt-2" data-toggle="modal" data-target="#suppModal{{ $res->user_id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Confirmation Modal-->
                                <div class="modal fade" id="suppModal{{ $res->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Êtes-vous sûr d'avoir supprimé cette responsable?</div>
                                            <form action="{{ route('gestion.responsables.delete', $res->user_id) }}" method="POST">
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
                                <!-- modifie Responsable Modal-->
                                <div class="modal fade" id="modifieResponsable{{ $res->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('gestion.responsables.update', $res->user_id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modifié les information du responsable</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>            
                                                <div class="modal-body">
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="nom" class="form-label">Nom de responsable</label>
                                                            <input type="text" class="form-control modifie @error('nom') is-invalid @enderror" placeholder="Ajouter nom de responsable" id="nom" name="nom" value="{{ $res->user->name }}" required>
                                                            @error('nom')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="prenom" class="form-label">Prenom de responsable</label>
                                                            <input type="text" class="form-control modifie @error('prenom') is-invalid @enderror" placeholder="Ajouter prenom de responsable" id="prenom" name="prenom" value="{{ $res->user->prenom }}" required>
                                                            @error('prenom')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6 mb-2">
                                                            <input type="text" class="form-control modifie @error('phone') is-invalid @enderror" placeholder="Téléphone" name="phone" value="{{ $res->user->phone }}" required>
                                                            @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-6 input-group mb-2">
                                                            <input type="datetime-local" class="form-control date modifie @error('birthday') is-invalid @enderror" placeholder="Date de naissance" name="birthday" value="{{ $res->user->birthday }}" required>
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
                                                                <input type="email" class="form-control modifie @error('email') is-invalid @enderror" placeholder="Exemple@email.com" id="email" name="email" value="{{ $res->user->email }}" required>
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
                                                                <input type="number" class="form-control @error('salaire') is-invalid @enderror" min="4000" placeholder="4000" id="salaire" name="salaire" value="{{ $res->salaire }}" required>
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
                                                            <input type="password" class="form-control @error('pass') is-invalid @enderror" placeholder="Password" id="password" name="pass" required>
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

    <!-- ajouter Responsable Modal-->
    <div class="modal fade" id="ajouterResponsable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('gestion.responsables.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un responsable</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-2">
                            <div class="col-md-6 mb-4">
                                <label for="nom" class="form-label">Nom de responsable</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Ajouter nom de responsable" id="nom" name="nom" value="{{ old('nom') }}">
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prenom de responsable</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="Ajouter prenom de responsable" id="prenom" name="prenom" value="{{ old('prenom') }}">
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
                                <label for="email" class="form-label">Email de responsable</label>
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
                                <label for="salarie" class="form-label">Salarié de responsable</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('salaire') is-invalid @enderror" min="4000" placeholder="4000" id="salarie" name="salaire" value="{{ old('salaire') }}">
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
                        <button class="btn btn-secondary" type="reset" data-dismiss="modal">Close</button>
                        <input type="reset" class="btn btn-secondary" value="Reset">
                        <input type="submit" class="btn btn-primary" value="Add">                    
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