<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Collaborateur;
use App\Models\Tache;
use Illuminate\Http\Request;

class RedacteurController extends Controller
{
    // permet de récupérer toutes les articles publiés
    public function allArticles(){
        $coll = Collaborateur::where('user_id', auth()->user()->id)->first();
        $articles = Article::where('redacteur_id', $coll->id)
                             ->where('etat', 'publié')->get();

        return view('collaborateurs.redacteur.article_public', [
            'articles'  => $articles
        ]);
    }

    // permet de récupérer toutes les nouveaux articles
    public function newArticles(){
        
        $coll = Collaborateur::where('user_id', auth()->user()->id)->first();
        $taches = Tache::where('coll_id', $coll->id)->get();
        
        return view('collaborateurs.redacteur.article_new', [
            'taches'    => $taches
        ]);
    }

    // permet d'afficher la page de la creation d'article
    public function create($id){        
        
        return view('collaborateurs.redacteur.create', [
            'article_id'    => $id            
        ]);
    }

    // permet d'enregistrer un article
    public function store(Request $req, $id){
        $title = $req->input('title');        
        $body  = $req->input('body');

        $article = Article::where('id', $id)->first();
        $coll    = Collaborateur::where('user_id', auth()->user()->id)->first();
        $tache   = Tache::where('article_id', $id)->where('coll_id', $coll->id)->first();

        $article->title = $title;
        $article->body  = $body;
        $article->photo = $req->image->store('images');

        $article->save();

        $tache->body = $body;
        $tache->status = 'encore';
        $tache->save();

        session()->flash('success', 'cet article a bien été enregistré');
        return redirect()->route('red.new.articles');
    }

    // permet de retourner la vue d'an article
    public function edit($id){

        // $article = Article::where('id', $id)->first();
        $article = Article::all();

        return view('collaborateurs.redacteur.update', [            
            'articles'   => $article,
            'article_id' => $id
        ]);
    }

    // 
    public function update(Request $req, $id){
        $title = $req->input('title');
        $body = $req->input('body');
        
        $article = Article::where('id', $id)->first();
        
        if($req->hasFile('image')){
            $article->title = $title;
            $article->body  = $body;
            if($article->photo){
                unlink(public_path('storage/').$article->photo);
            }
            $article->photo = $req->image->store('images');            
        }else {
            $article->title = $title;
            $article->body  = $body;
        }

        $article->save();

        session()->flash('success', 'cet article a été bien mis à jour');
        return redirect()->route('red.new.articles');
    }

    public function tacheFini($id){
        $tache   = Tache::where('id', $id)->first();

        $tache->status = 'finie';
        $tache->save();
        session()->flash('success', 'cette tâche est bien finie');

        return redirect()->route('red.new.articles');
    }
}
