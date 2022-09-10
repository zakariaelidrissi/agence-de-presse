@extends('layouts.master')

@section('title')
    Paiement des Salaries
@endsection

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Paiement des employés</h1>
        </div>

        <div class="card shadow mb-4">
            <form>
                <div class="card-header py-3">
                    <!-- ajouter responsable -->
                    <input type="submit" class="btn btn-outline-primary" value="Démmarer paiment">
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Poste</th>
                                    <th>Salaire (DH)</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collaborateurs as $coll)
                                    <tr>
                                        <td class="text-center align-middle">
                                            <input type="checkbox" value="">
                                        </td>
                                        <td class="align-middle">{{ $coll->user->name }}</td>
                                        <td class="align-middle">{{ $coll->user->email }}</td>
                                        <td class="align-middle">{{ $coll->compitance }}</td>
                                        <td class="align-middle">{{ $coll->salaire }}</td>                                        
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            
        </div>

    </div>

    <!-- Salaire Modal-->
    <div class="modal fade" id="modifieSalaire" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifie salaire de responsable</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">Logout</a>
                </div>
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
@endsection