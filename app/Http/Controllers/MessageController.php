<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // permet de lister toutes les messages n'est pas vu
    public function index(){
        $messages = Message::all();

        return view('admins.messages', ['messages' => $messages]);
    }

    // permet de supprimer un message
    public function destroy(){
        
    }
}
