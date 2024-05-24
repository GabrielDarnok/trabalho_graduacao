<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function destroy_user($id){
        
        // Localize o produto
        $user = User::find($id);
        if ($user) {

            $user->delete();
        }
        
        return redirect()->back()->with('msg', 'Usuário removido com sucesso');
    }
}
