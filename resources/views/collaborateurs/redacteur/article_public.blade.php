@extends('layouts.master')

@section('title')
    Les Articles Publiés
@endsection

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Les articles publiés</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Date de publication</th>
                                <th>Like</th>
                                <th>DisLike</th>
                                <th>Voir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td title="titre">{{ $article->title }}</td>
                                    <td>{{ $article->created_at }}</td>
                                    <td>
                                        @if ($article->likes)
                                            {{ $article->likes }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>
                                        @if ($article->dis_likes)
                                            {{ $article->dis_likes }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center"><a href="#" class="text-center" style="font-size: 13px;">
                                        <i class="fas fa-eye fa-2x"></i>
                                    </a></td>
                                </tr>                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection