<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Collaborateur;
use App\Models\Responsable;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // permet de lister les responsables
    public function getResponsable(){
        $listRes = Responsable::all();

        return view('admins.gestion.responsables', ['responsables' => $listRes]);
    }

    // permet de lister les collaborateur
    public function getCollaborateur(){
        $listCol = Collaborateur::where('is_freelancer', 0)->orderBy("score", "DESC")->get();
        $categories = Categorie::all();

        return view('admins.gestion.collaborateurs', [
            'collaborateur' => $listCol,            
            'categories'    => $categories
        ]);
    }

    // paiement des responsables
    public function priceResp(){
        $listRes = Responsable::all();
        return view('admins.paiement.responsables', ['responsables' => $listRes]);
    }
    
    // paiement des employers
    public function priceEmp(){
        $listColl = Collaborateur::where('is_freelancer', 0)->orderBy("score", "DESC")->get();

        return view('admins.paiement.salaries', ['collaborateurs' => $listColl]);
    }  

    // permet d'enregistrer un responsable dans la base de donnees
    public function createResponsable(Request $req){        
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
                'compitance' => 'responsable'
            ]);
        }else {
            User::create([
                'name'      => $req->input('nom'),
                'prenom'    => $req->input('prenom'),
                'email'     => $email,
                'phone'     => $req->input('phone'),
                'birthday'  => $req->input('birthday'),
                'password'  => Hash::make($req->input('pass')),
                'compitance' => 'responsable'
            ]);
        }

        // $user = User::find($email);
        $user = User::where('email', $email)->first();

        Responsable::create([
            'user_id'   => $user->id,
            'salaire'      => $req->input('salaire'),
            'compitance'   => 'responsable'
        ]);

        session()->flash('success', 'le responsable a bien été enregistré');

        return redirect()->route('gestion.responsables');
    }

    // permer d'enregistrer un collaborateur dans la base de donnees
    public function createCollaborateur(Request $req){
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

        // $user = User::find($email);
        $user = User::where('email', $email)->first();

        Collaborateur::create([
            'user_id'       => $user->id,
            'salaire'       => $req->input('salaire'),
            'compitance'    => $req->input('customRadioInline1'),
            'theme'         => $req->input('theme'),
            'disponible'    => 'oui',
            'score'         => 60
        ]);

        session()->flash('success', 'le collaborateur a été bien enregistré');

        return redirect()->route('gestion.collaborateurs');
        // return response()->json([
        //     'status'    => 200
        // ]);
    }

    // permete de modifier un responsable
    public function updateResponsable(Request $req, $id){

        $user = User::where('id', $id)->first();
        $user->name     = $req->input('nom');
        $user->prenom   = $req->input('prenom');
        $user->email    = $req->input('email');
        $user->phone    = $req->input('phone');
        $user->birthday = $req->input('birthday');
        
        if ( $req->has('pass') ){
            $user->password = Hash::make($req->input('pass'));
        }
        if($req->hasFile('image')){
            unlink(public_path('storage/').$user->photo);            
            $user->photo = $req->image->store('images');
        }

        $user->save();
        
        $resp = Responsable::where('user_id', $id)->first();
        $resp->salaire  = $req->input('salaire');
        $resp->save();

        session()->flash('success', 'le responsable a été bien mis à jour');
        return redirect()->route('gestion.responsables');
    }

    // permete de modifier un collaborateur
    public function updateCollaborateur(Request $req, $id){
        $user = User::where('id', $id)->first();
        $user->name     = $req->input('nom');
        $user->prenom   = $req->input('prenom');
        $user->email    = $req->input('email');
        $user->phone    = $req->input('phone');
        $user->birthday = $req->input('birthday');
        if ( $req->has('pass') ){
            $user->password = Hash::make($req->input('pass'));
        }
        if($req->hasFile('image')){
            unlink(public_path('storage/').$user->photo);
            $user->photo = $req->image->store('images');
        }

        $user->save();
        
        $coll = Collaborateur::where('user_id', $id)->first();
        $coll->salaire = $req->input('salaire');
        $coll->save();

        session()->flash('success', 'le collaborateur a été bien mis à jour');
        return redirect()->route('gestion.collaborateurs');
    }

    // permet de supprimer un responsable
    public function destroyResponsable($id){
        
        $user = User::where('id', $id)->first();
        unlink(public_path('storage/').$user->photo);
        $user->delete();

        session()->flash('success', 'le responsable a bien été supprimé');
        return redirect()->route('gestion.responsables');
    }

    // permet de supprimer un collaborateur
    public function destroyCollaborateur($id){
        $user = User::where('id', $id)->first();
        unlink(public_path('storage/').$user->photo);
        $user->delete();

        session()->flash('success', 'le collaborateur a été bien supprimé');
        return redirect()->route('gestion.collaborateurs');
    }

    // permet de recuperer toutes les pigistes
    public function pigistes(){
        $pig = Collaborateur::where('is_freelancer', 1)->get();
        $taches = Tache::all();

        return view('admins.paiement.independants', [
            'pigistes'  => $pig,
            'taches'    => $taches
        ]);
    }
}
