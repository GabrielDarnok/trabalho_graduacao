<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Number;
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
        #if ($dados !== null) {
        #    $urlAnterior = url()->previous();
        #    dd($urlAnterior);
        #    return redirect()->back()->with('err', 'Você já está cadastrado.');
        #}else{
        return view('cadastroPage',['dados' => $dados]);
        #}
    }

    public function messageWhats(){
        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }
        return redirect()->back()->with('msg', 'Encaminharemos uma mensagem em seu whatsapp para confirmar seu pedido.');
    }

    public function dashboardAdmin(){
        if(!isset(auth()->user()->id) || auth()->user()->role != "admin"){
            return redirect('/');
        }

        $pedidos = Pedido::join('users', 'pedidos.id_usuario', '=', 'users.id')
                  ->select('pedidos.*', 'users.email')
                  ->get();

        return view('admin.dashboard_admin',['pedidos'=>$pedidos]);
    }

    public function dadosUser(){
        if(!isset(auth()->user()->id) || auth()->user()->role != "admin"){
            return redirect('/');
        }

        $dados_users = Number::with('user')->get();

        return view('admin.dados_usuarios', ['dados_users' => $dados_users]);
    }

    public function produtosAdmin(){
        if(!isset(auth()->user()->id) || auth()->user()->role != "admin"){
            return redirect('/');
        }

        $products = Product::all();

        $uniqueCategories = $products->pluck('categoria_produto')->unique();

        return view('admin.produtos_admin', ['categorys'=>$uniqueCategories, 'products'=>$products]);
    }

    public function changePassword(){
        return view('auth.forgot-password');
    }

    public function pedido(){
        $pedido = Pedido::where('id_usuario', auth()->user()->id)->get();
        
        $dados = parent::verificaUsuarioLog();
        
        return view('pedido', ['pedido'=>$pedido, 'dados' => $dados]);
    }

    public function usuarioAdmin(){
        $users = User::all();

        if(!isset(auth()->user()->id) || auth()->user()->role != "admin"){
            return redirect('/');
        }

        return view('admin.usuario_admin', ['users'=>$users]);
    }
}
