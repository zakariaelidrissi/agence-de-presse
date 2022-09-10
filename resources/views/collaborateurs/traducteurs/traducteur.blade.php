<div class="container">

    <!-- Page Heading -->
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Traduction d'articles</h1>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date de début</th>
                            <th>Date limite</th>
                            <th>statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($articles as $article)
                            @foreach ($taches as $tache)
                                @if ($article->id == $tache->article_id)
                                    <tr>
                                        <td title="titre">{{ $article->title }}</td>
                                        <td> {{ $tache->start_date }} </td>
                                        <td> {{ $tache->end_date }} </td>
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
                                        <td class="text-center">
                                            @if ($tache->status != 'finie' && $tache->status != 'valider')
                                                <form action="{{ route('traducteur.tache.fini', $tache->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <a href="{{ route('traducteur.show.tache', $tache->id) }}" style="font-size: 20px;" class="mr-4 d-md-inline-block">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="submit" class="d-inline-block mt-2" style="font-size: 20px;border: none;background: none;color: deepskyblue;"> 
                                                        <i class="fas fa-check-double"></i>
                                                    </button>                                                    
                                                </form>                                                 
                                            @endif
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

</div>