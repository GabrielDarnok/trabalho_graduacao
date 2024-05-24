<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function destroyUser($id){
        
        // Localize o Usuario
        $user = User::find($id);
        if ($user) {

            $user->delete();
        }
        
        return redirect()->back()->with('msg', 'Usuário removido com sucesso');
    }
    
    public function changeUser($id){

        // Localize o produto
        $user = User::find($id);
        if ($user) {

            $user->role = "user";
            $user->save();
        }
        
        return redirect()->back()->with('msg', 'Role alterada com sucesso');
    }

    public function changeAdmin($id){

        // Localize o produto
        $user = User::find($id);
        if ($user) {

            $user->role = "admin";
            $user->save();
        }
        
        return redirect()->back()->with('msg', 'Role alterada com sucesso');
    }
}
