@extends('layouts.index')

@section('title')
    Agence de Presse - NAZA
@endsection

@section('content')
    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="sn-container">
                        @foreach ($article as $art)                            
                            <div class="sn-img">
                                @if ($art->photo)
                                    <img src="{{ asset('storage/'.$art->photo) }}" />
                                @else
                                    <img src="{{ asset('img/news-825x525.jpg') }}" />
                                @endif
                            </div>
                            <div class="sn-content">
                                <h1 class="sn-title">{{ $art->title }}</h1>
                                <ul class="blog-like mt-3 mb-4">
                                    <li>
                                        <a href="">
                                            <i class="fas fa-thumbs-up"></i>
                                            @if ($art->likes)
                                                {{ $art->likes }}
                                            @else
                                                0
                                            @endif
                                        </a>
                                        <li>
                                            <a href="">
                                                <i class="fas fa-thumbs-down"></i>
                                                @if ($art->dis_likes)
                                                    {{ $art->dis_likes }}
                                                @else
                                                    0
                                                @endif
                                            </a>
                                        </li>
                                    </li>
                                </ul>
                                @foreach ($tache as $ta)
                                    @if ($ta->body)
                                        <p> 
                                            {{ $ta->body }}
                                        </p>                                                                  
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="blog-author">
                        @foreach ($usercor as $us)
                            <div class="media align-items-center mb-2">
                                @if ($us->photo)
                                    <img src="{{ asset('storage/'.$us->photo) }}" class="rounded-circle">
                                @else
                                    <img src="{{ asset('img/undraw_profile.svg') }}" class="rounded-circle">
                                @endif
                                <div class="media-body">                                    
                                    {{ $us->name.' '.$us->prenom }}
                                </div>
                            </div>
                        @endforeach
                        @foreach ($userred as $us)
                            <div class="media align-items-center">
                                @if ($us->photo)
                                    <img src="{{ asset('storage/'.$us->photo) }}" class="rounded-circle">
                                @else
                                    <img src="{{ asset('img/undraw_profile.svg') }}" class="rounded-circle">
                                @endif
                                <div class="media-body">                                    
                                    {{ $us->name.' '.$us->prenom }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 mt-5 mt-lg-2">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach ($articles as $art)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            @if ($art->photo)
                                                <img src="{{ asset('storage/'.$art->photo) }}" />
                                            @else
                                                <img src="{{ asset('img/news-350x223-1.jpg') }}" />
                                            @endif
                                        </div>
                                        <div class="nl-title">
                                            <a href=""> {{ $art->title }} </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    <li><a href="">Cat 1</a><span>(98)</span></li>
                                    <li><a href="">Cat 2</a><span>(87)</span></li>
                                    <li><a href="">Cat 3</a><span>(76)</span></li>
                                    <li><a href="">Cat 4</a><span>(65)</span></li>
                                    <li><a href="">Cat 5</a><span>(54)</span></li>
                                    <li><a href="">Cat 6</a><span>(43)</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection