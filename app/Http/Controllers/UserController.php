<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Number;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

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

    public function dadosPhone(Request $request){
        
        $number = new Number();
        
        $numberExist = Number::where('number_phone', $request->number_phone)->exists();

        if($numberExist){
            return redirect()->back()->with('err', 'Numero já está cadastrado');
        }

        $number->id_usuario = Auth::user()->id;
        $number->number_phone = $request->number_phone;

        $number->save();

        return redirect()->back()->with('msg', 'Numero cadastrado');
    }
}
