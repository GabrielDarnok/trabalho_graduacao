<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Pedido;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Gate;

class redirectController extends Controller
{
    public function index(){
        
        $produtcs = Product::all();

        $dados = parent::verificaUsuarioLog();

        return view('index',['products' => $produtcs, 'dados' => $dados]);
    }
    public function cart(){
        
        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }
        
        $dados = parent::verificaUsuarioLog();

        return view('cart', ['dados' => $dados]);
        
    }
    public function contato(){

        $dados = parent::verificaUsuarioLog();

        return view('contato',['dados' => $dados]);
    }
    public function details(){
        
        $dados = parent::verificaUsuarioLog();

        return view('details',['dados' => $dados]);
    }
    public function profile($id){
        
        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }

        $user = User::findOrFail($id);
        
        #Condição que verifica se o usuario que está acessando a view  tem o mesmo ID do usuario autenticado
        if ($user->id == auth()->user()->id) {
            return view('user.profile',['dados' => $dados]);
        }

        abort(403); // Acesso não autorizado
    }
    public function registro(){

        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }

        return view('user.registro_end', ['dados' => $dados]);
    }
    public function shop(Request $request) {
        $busca = $request->input('search');
    
        $dados = parent::verificaUsuarioLog();
    
        $produtcs = Product::all();
    
        return view('shop', ['products' => $produtcs, 'dados' => $dados, 'busca' => $busca]);
    }
    public function sobre(){
        
        $dados = parent::verificaUsuarioLog();

        return view('sobre',['dados' => $dados]);
    }
    public function cadastroPage(){
        
        $dados = parent::verificaUsuarioLog();
        
        return view('cadastroPage',['dados' => $dados]);
    }
}
