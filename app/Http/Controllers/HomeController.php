<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Collaborateur;
use App\Models\Tache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        if(auth()->user()->compitance == 'correcteur' || auth()->user()->compitance == 'traducteur'){
            $coll = Collaborateur::where('user_id', auth()->user()->id)->first();
            $taches = Tache::where('coll_id', $coll->id)->get();
            $article = Article::all();
    
            return view('home', [
                'taches'   => $taches,
                'articles' => $article
            ]);
        }else {
            return view('home');
        }
    }
}
