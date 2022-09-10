<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tache;
use Illuminate\Http\Request;

class CorrecteurController extends Controller
{
    // permet d'afficher le contenu d'une tache
    public function show($id){

        $tache = Tache::where('id', $id)->first();
        $article = Article::where('id', $tache->article_id)->get();

        return view('collaborateurs.correcteurs.show', [
            'article'   => $article
        ]);
    }

    // permet de modifier un article
    public function edit(Request $req ,$id){        
        
        $article = Article::where('id', $id)->first();
        $tache   = Tache::where('coll_id', $article->correcteur_id)->first();

        $title = $req->input('title');
        $body  = $req->input('body');

        $article->title = $title;
        $article->body  = $body;
        $article->update();

        $tache->body  = $body;
        $tache->status = 'encore';
        $tache->update();

        session()->flash('success', 'la tache a bien été corrigé');
        return redirect()->route('home');
    }

    // permet de modifier le status d'une tache 'finie'
    public function tacheFini($id){
        $tache   = Tache::where('id', $id)->first();    

        $tache->status = 'finie';
        $tache->update();
        session()->flash('success', 'cette tâche est bien finie');

        return redirect()->route('home');
    }
}
