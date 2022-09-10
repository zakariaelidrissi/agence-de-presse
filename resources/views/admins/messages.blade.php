@extends('layouts.master')

@section('title')
    Gestion des messages
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Messages</h1>
        </div>

        <!-- Content Row - message 1 -->
        <div class="row">
            <div class="col-sm-12">
                @foreach ($messages as $msg)
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $msg->title }}</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">{{ $msg->user->compitance }}</div>
                                    <a href="#" class="dropdown-item">{{ $msg->user->name }}</a>
                                    <a class="dropdown-item" href="mailto:adr@gmail.com">Réponse</a>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#suppModal">Suppression</a>
                                        {{-- <button class="dropdown-item" type="submit" style="font-size: 10px;border: none;background: none;color: red;">
                                            Suppression
                                        </button> --}}
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            {{ $msg->body }}
                        </div>
                    </div>                    
                @endforeach
            </div>            
        </div>

    </div>

    <!-- Confirmation Modal-->
    <div class="modal fade" id="suppModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Êtes-vous sûr d'avoir supprimé ce message ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">Suppression</a>
                </div>
            </div>
        </div>
    </div>
@endsection