<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Collaborateur;
use App\Models\Tache;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResponsableController extends Controller
{
    // permer d'enregistrer un collaborateur dans la base de donnees
    public function store(Request $req){
        $email = $req->input('email');
        if($req->hasFile('image')){
            User::create([
                'name'      => $req->input('nom'),
                'prenom'    => $req->input('prenom'),
                'email'     => $email,
                'phone'     => $req->input('phone'),
                'birthday'  => $req->input('birthday'),
                'password'  => Hash::make($req->input('pass')),
                'photo'     => $req->image->store('images'),
                'compitance' => $req->input('customRadioInline1')
            ]);
        }else {
            User::create([
                'name'      => $req->input('nom'),
                'prenom'    => $req->input('prenom'),
                'email'     => $email,
                'phone'     => $req->input('phone'),
                'birthday'  => $req->input('birthday'),
                'password'  => Hash::make($req->input('pass')),
                'compitance' => $req->input('customRadioInline1')
            ]);
        }
        
        $user = User::where('email', $email)->first();

        Collaborateur::create([
            'user_id'   => $user->id,
            'salaire'      => $req->input('salaire'),
            'compitance'   => $req->input('customRadioInline1'),
            'theme'        => $req->input('theme'),
            'disponible'   => 'oui'
        ]);
        
        session()->flash('success', 'le collaborateur a été bien enregistré');

        return redirect()->route('collaborateurs.salaries');        
    }

    // create categorie
    public function createCat(Request $req){

        Categorie::create([
            'categorie' => $req->input('categorie')
        ]);

        session()->flash('success', 'la catégorie a bien été enregistrée');

        return redirect()->route('articles.new');

    }

    // permet de récupérer toutes les articles publies
    public function articlesPublic(){

        $article = Article::where('etat', 'publie')->get();
        return view('responsables.articlesPub', [
            'allArticle'    => $article
        ]);
    }

    // permet d'afficher la pages des nouveux articles
    public function articlesNew(){

        $categories = Categorie::all();
        $coll       = Collaborateur::orderBy("score", "DESC")->get();
        $articles   = Article::all();
        $taches     = Tache::all();

        return view('responsables.articlesNuv', [
            'categories'    => $categories,
            'collaborateur' => $coll,
            'articles'      => $articles,
            // 'taches'        => $taches
        ]);
    }

    // permet de publie un article
    public function publieArticle($id){
        $article = Article::where('id', $id)->first();
        $article->update([
            'etat'  => 'publie'
        ]);

        session()->flash('success', 'l\'article est publié');
        return redirect()->route('articles.new');
    }

    // permet de récupérer toutes les employes
    public function allCollaborateurs(){

        $coll = Collaborateur::where('is_freelancer', 0)->orderBy('score', 'DESC')->get();
        $categories = Categorie::all();
        return view('responsables.collSalarie', [
            'allColl'   => $coll,
            'categories'    => $categories
        ]);
    }

    // permet de récupérer toutes les pigistes
    public function allPigistes(){
        
        $pig = Collaborateur::where('is_freelancer', 1)->orderBy('score', 'DESC')->get();
        $categories = Categorie::all();
        return view('responsables.collIndependant', [
            'allPig'   => $pig,
            'categories'    => $categories
        ]);
    }

    // permet de créer un pigiste
    public function createPigiste(Request $req){

        $email = $req->input('email');
        if($req->hasFile('image')){
            User::create([
                'name'          => $req->input('nom'),
                'prenom'        => $req->input('prenom'),
                'email'         => $email,
                'phone'         => $req->input('phone'),
                'birthday'      => $req->input('birthday'),
                'password'      => Hash::make($req->input('pass')),
                'photo'         => $req->image->store('images'),
                'compitance'    => $req->input('poste')
            ]);
        }else {
            User::create([
                'name'          => $req->input('nom'),
                'prenom'        => $req->input('prenom'),
                'email'         => $email,
                'phone'         => $req->input('phone'),
                'birthday'      => $req->input('birthday'),
                'password'      => Hash::make($req->input('pass')),
                'compitance'    => $req->input('poste')
            ]);
        }
        
        $user = User::where('email', $email)->first();

        Collaborateur::create([
            'user_id'       => $user->id,            
            'compitance'    => $req->input('poste'),
            'theme'        => $req->input('theme'),
            'is_freelancer' => 1,
            'disponible'    =>  'oui'
        ]);        

        session()->flash('success', 'the pigiste has been well registered');

        return redirect()->route('collaborateurs.indep');
    }

    // permet de suprimer un pigiste
    public function destroyPigiste($id){
        $user = User::where('id', $id)->first();
        if($user->photo){
            unlink(public_path('storage/').$user->photo);
        }
        $user->delete();

        session()->flash('success', 'le pigiste a bien été supprimé');
        return redirect()->route('collaborateurs.indep');
    }

    // permet de modifier un pigiste
    public function updatePigiste(Request $req, $id){
        
        $user = User::where('id', $id)->first();
        $user->name     = $req->input('nom');
        $user->prenom   = $req->input('prenom');
        $user->email    = $req->input('email');
        $user->phone    = $req->input('phone');
        $user->birthday = $req->input('birthday');
        $user->compitance = $req->input('poste');
        
        if ( $req->has('pass') ){
            $user->password = Hash::make($req->input('pass'));
        }
        if($req->hasFile('image')){
            if($user->photo){
                unlink(public_path('storage/').$user->photo);
            }
            $user->photo = $req->image->store('images');
        }

        $user->save();
        
        $pig = Collaborateur::where('user_id', $id)->first();
        $pig->compitance = $req->input('poste');
        $pig->save();

        session()->flash('success', 'le pigiste a bien été mis à jour');
        return redirect()->route('collaborateurs.indep');
    }

    // permet de modifier le score d'un collaborateur
    public function updateScore(Request $req, $id){
        $coll = Collaborateur::where('id', $id)->first();

        $coll->score = $req->input('score');
        $coll->save();

        session()->flash('success', 'le score a été bien mis à jour');
        return redirect()->route('collaborateurs.salaries');
    }

    // permet de créer un article
    public function createArticle(Request $req){
        
        $title      = $req->input('title');
        $categorie  = $req->input('categorie');        
        $etat       = 'pas encore';

        Article::create([
            'title'         => $title,
            'categorie'     => $categorie,            
            'etat'          => $etat
        ]);

        session()->flash('success', 'the article has been well registered');
        return redirect()->route('articles.new');

    }

    // permet d'ajouter une tache a un redacteur
    public function addTachesRed(Request $req, $id){        
        $start_date     = $req->input('start_date');
        $end_date       = $req->input('end_date');
        $coll           = $req->input('coll');

        // $mytime = Carbon::now()->format('d-m-Y');
        // if ($start_date->gte($mytime) && $end_date->gte($mytime) ){
            // if ($start_date->gt($end_date)){
                Tache::create([
                    'coll_id'       => $coll,
                    'article_id'    => $id,
                    'start_date'    => $start_date,
                    'end_date'      => $end_date,
                    'status'        => 'pas encore'
                ]);

                $article = Article::where('id', $id)->first();
                $article->update([
                    'redacteur_id'  => $coll
                ]);

                $collaborateur = Collaborateur::where('id', $coll)->first();
                $collaborateur->update([
                    'disponible'    => 'non'
                ]);

                session()->flash('success', 'the task has been added');
        //     }else {
        //         session()->flash('error', 'Start date must be greater than end date');
        //     }
        // }else {
        //     session()->flash('error', 'Start date and end date must be greater than or equal to today\'s date');
        // }    
        return redirect()->route('articles.new');
    }

    // permet d'ajouter une tache a un correcteur
    public function addTachesCor(Request $req, $id){
        $start_date     = $req->input('start_date');
        $end_date       = $req->input('end_date');
        $coll           = $req->input('coll');

        Tache::create([
            'coll_id'       => $coll,
            'article_id'    => $id,
            'start_date'    => $start_date,
            'end_date'      => $end_date,
            'status'        => 'pas encore'
        ]);

        $article = Article::where('id', $id)->first();
        $article->update([
            'correcteur_id'  => $coll
        ]);

        $collaborateur = Collaborateur::where('id', $coll)->first();
        $collaborateur->update([
            'disponible'    => 'non'
        ]);

        session()->flash('success', 'la tache a bien été ajoutée');
        return redirect()->route('articles.new');
    }

    // permet d'ajouter une tache a un traducteur
    public function addTachesTrad(Request $req, $id){
        $start_date     = $req->input('start_date');
        $end_date       = $req->input('end_date');
        $coll           = $req->input('coll');

        // $mytime = Carbon::now()->format('d-m-Y');
        // if ($start_date >= $mytime && $end_date >= $mytime){                        
            // if ($start_date > $end_date){
                Tache::create([
                    'coll_id'       => $coll,
                    'article_id'    => $id,
                    'start_date'    => $start_date,
                    'end_date'      => $end_date,
                    'status'        => 'pas encore'
                ]);
        
                $article = Article::where('id', $id)->first();
                $article->update([
                    'traducteur_id'  => $coll
                ]);
        
                $collaborateur = Collaborateur::where('id', $coll)->first();
                $collaborateur->update([
                    'disponible'    => 'non'
                ]);
                session()->flash('success', 'the task has been added');
        //     }else{
        //         session()->flash('error', 'Start date must be greater than end date');
        //     }
        // }else {
        //     session()->flash('error', 'Start date and end date must be greater than or equal to today\'s date');
        // }


        return redirect()->route('articles.new');
    }
    
    // permet d'ajouter une tache a un pigiste
    public function addTachesPig(Request $req, $id){
        $post           = $req->input('customRadioInline2');
        $start_date     = $req->input('start_date');
        $end_date       = $req->input('end_date');
        $coll           = $req->input('pig');
        $prix           = $req->input('salaire');

        Tache::create([
            'coll_id'       => $coll,
            'article_id'    => $id,
            'prix'          => $prix,
            'start_date'    => $start_date,
            'end_date'      => $end_date,
            'status'        => 'pas encore'
        ]);

        $article = Article::where('id', $id)->first();
        if($post == 'redacteur'){
            $article->update([
                'redacteur_id'  => $coll
            ]);
        }
        else if($post == 'correcteur'){
            $article->update([
                'correcteur_id' => $coll
            ]);
        }
        else {
            $article->update([
                'traducteur_id' => $coll
            ]);
        }

        session()->flash('success', 'la tache a bien été ajoutée');
        return redirect()->route('articles.new');
    }    

    // permet de supprimer un article
    public function destroyArticle($id){
        $article = Article::where('id', $id)->first();
        if($article->photo){
            unlink(public_path('storage/').$article->photo);
        }
        $article->delete();

        session()->flash('success', 'cet article a bien été supprimé');
        return redirect()->route('articles.new');
    }

    // permet d'afficher le contenu d'une tache
    public function show($id){
        $tache = Tache::where('id', $id)->first();
        $status = $tache->status;
        $article = Article::where('id', $tache->article_id)->get();

        return view('responsables.show', [
            'article'   => $article,
            'status'    => $status,
            'tache_id'  => $id,
            'tache'     => $tache
        ]);
    }

    // permet de valider une tache
    public function valTache($id){
        $tache = Tache::where('id', $id)->first();
        $tache->status = 'valider';
        $tache->update();

        $coll = Collaborateur::where('id', $tache->coll_id)->first();
        $coll->disponible = 'oui';
        $coll->update();

        session()->flash('success', 'cet tache a bien été valide');
        return redirect()->route('res.show.tache', $id);
    }

    // permet de refuser une tache
    public function refTache($id){
        $tache = Tache::where('id', $id)->first();
        $tache->status = 'refuser';
        $tache->save();

        session()->flash('success', 'cet tache a bien été refuse');
        return redirect()->route('res.show.tache', $id);
    }
}
