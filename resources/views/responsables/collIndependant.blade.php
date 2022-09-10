@extends('layouts.master')

@section('title')
    Collaborateurs independants
@endsection

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gestion des pigistes</h1>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- ajouter responsable -->
                <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#ajouterPigiste">
                    <span class="text font-weight-bold">Ajouter pigiste</span>
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
                                <th>Theme</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allPig as $pig)
                                <tr>
                                    @if ($pig->user->photo)
                                        <td class="text-center">
                                            <img class="img-profile rounded-circle" style="width: 40px;"
                                            src="{{ asset('storage/'.$pig->user->photo) }}">
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <img class="img-profile rounded-circle" style="width: 40px;"
                                            src="{{ asset('img/undraw_profile.svg') }}">
                                        </td>
                                    @endif
                                    <td class="align-middle"> {{ $pig->user->name.' '.$pig->user->prenom }} </td>
                                    <td class="align-middle"> {{ $pig->compitance }} </td>
                                    <td class="align-middle"> {{ $pig->theme }} </td>
                                    <td class="align-middle"> {{ $pig->user->email }} </td>
                                    <td class="align-middle"> {{ $pig->user->phone }} </td>
                                    <td class="text-center">
                                        <a href="#"style="font-size: 20px;" class="mr-md-4 d-md-inline-block d-block"
                                            data-toggle="modal" data-target="#modifiePigiste{{ $pig->user_id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" style="font-size: 20px;" class="d-inline-block mt-2"
                                            data-toggle="modal" data-target="#suppModal{{ $pig->user_id }}">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Confirmation Modal-->
                                <div class="modal fade" id="suppModal{{ $pig->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Êtes-vous sûr d'avoir supprimé ce pigiste ?</div>
                                            <form action="{{ route('delete.pigiste', $pig->user_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-footer">                                                    
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>                                                    
                                                    <button class="btn btn-primary" type="submit">Suppression</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modifie Pigiste Modal-->
                                <div class="modal fade" id="modifiePigiste{{ $pig->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('update.pigiste', $pig->user_id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modifie un pigiste</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row mb-2">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="nom" class="form-label">Nom de pigiste</label>
                                                            <input type="text" class="form-control" placeholder="Ajouter nom de responsable" id="nom" name="nom" value="{{ $pig->user->name }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="prenom" class="form-label">Prenom de pigiste</label>
                                                            <input type="text" class="form-control" placeholder="Ajouter prenom de responsable" id="prenom" name="prenom" value="{{ $pig->user->prenom }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-sm-6 mb-2">
                                                            <input class="form-control" type="text" placeholder="Téléphone" name="phone" value="{{ $pig->user->phone }}">
                                                        </div>
                                                        <div class="col-sm-6 input-group mb-2">
                                                            <input class="form-control date" type="datetime-local" placeholder="Date de naissance" name="birthday" value="{{ $pig->user->birthday }}">
                                                            <i class="fas fa-calendar-alt fa-2x input-group-text"></i>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="email" class="form-label">Email de pigiste</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">@</span>
                                                                <input type="email" class="form-control" placeholder="Exemple@email.com" id="email" name="email" value="{{ $pig->user->email }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label for="role" class="form-label">Poste de pigiste</label>
                                                            <select class="form-control" id="role" required name="poste">
                                                                @if ($pig->user->compitance == 'redacteur')
                                                                    <option value="{{ $pig->user->compitance }}">Rédacteur</option>
                                                                    <option value="correcteur">Correcteur</option>
                                                                    <option value="traducteur">Traducteur</option>                                                                    
                                                                @endif
                                                                @if ($pig->user->compitance == 'correcteur')
                                                                    <option value="{{ $pig->user->compitance }}">Correcteur</option>
                                                                    <option value="redacteur">Rédacteur</option>
                                                                    <option value="traducteur">Traducteur</option>                                                                    
                                                                @endif
                                                                @if ($pig->user->compitance == 'traducteur')
                                                                    <option value="{{ $pig->user->compitance }}">Traducteur</option>
                                                                    <option value="redacteur">Rédacteur</option>                                                                   
                                                                    <option value="correcteur">Correcteur</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="password" class="form-label">Mot de passe</label>
                                                            <input type="password" class="form-control" placeholder="Password" id="password" name="pass">
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label for="confPassword" class="form-label">Confirmation du mot de passe</label>
                                                            <input type="password" class="form-control" placeholder="Password" id="confPassword" name="confpass">
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="formFile" class="form-label">Modifie photo de pigiste</label>
                                                            <input class="form-control-file" type="file" id="formFile">
                                                        </div>
                                                    </div> --}}
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Modifie photo de pigiste</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="formFile" name="image">
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
                                                    <button class="btn btn-secondary" type="reset" data-dismiss="modal">Fermer</button>
                                                    <input type="reset" class="btn btn-secondary">
                                                    <input type="submit" class="btn btn-primary" value="Modifie">
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
    

    <!-- ajouter Pigiste Modal-->
    <div class="modal fade" id="ajouterPigiste" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('create.pigiste') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un pigiste</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-2">
                            <div class="col-md-6 mb-4">
                                <label for="nom" class="form-label">Nom de pigiste</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Ajouter nom de responsable" id="nom" name="nom" value="{{ old('nom') }}">
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prenom de pigiste</label>
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
                                <label for="email" class="form-label">Email de pigiste</label>
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
                                <label for="role" class="form-label">Poste de pigiste</label>
                                <select class="form-control @error('poste') is-invalid @enderror" id="role" required name="poste">
                                    <option value="">Ajouter poste de pigiste</option>
                                    <option value="redacteur">Rédacteur</option>
                                    <option value="correcteur">Correcteur</option>
                                    <option value="traducteur">Traducteur</option>
                                </select>
                                @error('poste')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                <label class="form-label">Ajouter photo de pigiste</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="formFile" name="image">
                                    <label class="custom-file-label" for="image">Choisir image</label>
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
                        <button class="btn btn-secondary" type="reset" data-dismiss="modal">Fermer</button>
                        <input type="reset" class="btn btn-secondary">
                        <input type="submit" class="btn btn-primary" value="Ajouter">
                    </div>
                </form> 
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
