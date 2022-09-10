@extends('layouts.master')

@section('title')
    Readacteur Page
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
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

            
            <!-- nombre d'Articles en préparation -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Articles en préparation</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Score
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">65%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-star-half-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Bar Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div
                        class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">nombre d'articles par mois</h6>
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
                                <i class="fas fa-circle"></i> Like
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle one"></i> DisLike
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Top articles Heading -->
            <div class="mb-4 container-fluid">
                <h1 class="h5 mb-0 text-gray-800">Meilleures articles (Mois)</h1>
            </div>
            <!-- Top articles Body -->
            <!-- art 1 -->
        
                <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a href="#">
                                <h6 class="m-0 font-weight-bold text-primary">Titre d'article</h6>
                            </a>
                            <div>
                                <span class="btn btn-primary text-xs">
                                    <span class="text">Catégorie</span>
                                </span>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, excepturi, quisquam est rem ullam quam provident fugiat fuga beatae optio iure aliquid maxime, hic inventore ad! Atque odit repellat soluta. 
                        </div>
                    </div>
                </div>
            
            <!-- end art 1 -->
        </div>

    </div>
@endsection