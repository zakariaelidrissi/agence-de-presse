@extends('layouts.master')

@section('title')
    Paiement des responsables
@endsection

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Paiement des responsables</h1>
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
                                    <th>Téléphone</th>
                                    <th>Salaire (DH)</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($responsables as $res)
                                    <tr>
                                        <td class="text-center align-middle">
                                            <input type="checkbox" value="">
                                        </td>
                                        <td class="align-middle">{{ $res->user->name }}</td>
                                        <td class="align-middle">{{ $res->user->email }}</td>
                                        <td class="align-middle">{{ $res->user->phone }}</td>
                                        <td class="align-middle">{{ $res->salaire }}</td>                                        
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            
        </div>


    </div>
    
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src=".{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection