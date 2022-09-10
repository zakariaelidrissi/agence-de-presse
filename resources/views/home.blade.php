@extends('layouts.master')


@section('title')
    @if (auth()->user()->is_admin)
        Admin Page
    @else
        Responsable Page
    @endif
@endsection

@section('content')
    @if (auth()->user()->compitance !== 'correcteur' && auth()->user()->compitance !== 'traducteur')
        <div class="container-fluid">
            
            {{-- Page Heading --}}            
            <div class="mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>             
            @if (auth()->user()->is_admin)
                {{-- Content Row --}}
                <div class="row">

                    <!-- nombre total d'article -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Nombre d'article (total)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <!-- nombre de clients -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Nombre de clients</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- nombre d'employé -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Nombre d'employé</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
            @endif

            @if (auth()->user()->compitance === 'responsable')
                <div class="row">

                    <!-- nombre total d'article -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Nombre d'article (total)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <!-- nombre d'Articles préparés -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Articles préparés (Mois)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- nombre d'Articles en préparation -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Articles en préparation</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
                                        
            @if (auth()->user()->compitance === 'redacteur')
                <div class="row">
    
                    <!-- Bar Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header -->
                            <div
                                class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Nombre d'articles par mois</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-bar">
                                    <canvas id="myBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Like / DisLike</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-primary"></i> Like
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> DisLike
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                {{-- Content Row --}}
                <div class="row">
                    {{-- Top articles Heading --}}
                    <div class="mb-4 container-fluid">
                        <h1 class="h5 mb-0 text-gray-800">Meilleures articles (Mois)</h1>
                    </div>
                    {{-- Top articles Body
                    art 1 --}}
                    <a class ="d-flex align-items-center" href="#">
                        <div class="col-sm-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Titre d'article</h6>
                                    <div>
                                        <a href="javascript:void(0)" class="btn btn-primary">
                                            <span class="text">Catégorie</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, excepturi, quisquam est rem ullam quam provident fugiat fuga beatae optio iure aliquid maxime, hic inventore ad! Atque odit repellat soluta. 
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- end art 1 -->
                </div>                
            @endif                               

        </div>
    @endif

    @if (auth()->user()->compitance === 'correcteur')
        @include('collaborateurs.correcteurs.correcteur')
    @endif

    @if (auth()->user()->compitance === 'traducteur')
        @include('collaborateurs.traducteurs.traducteur')
    @endif
@endsection