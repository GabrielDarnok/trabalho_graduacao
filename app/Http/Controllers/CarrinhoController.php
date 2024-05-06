<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Product;

class CarrinhoController extends Controller
{
    public function add_carrinho(Request $request){
        
        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }
        // Verificar se o produto já está no carrinho para o usuário atual
        $car = Car::where('id_produto', $request->id)
        ->where('id_usuario', auth()->user()->id)->
        where('cor_car', $request->cor_produto)->
        where('tamanho_car',$request->tamanho_roupa)
        ->first();

        if ($car) {    
            // Se o produto já está no carrinho, atualize a quantidade
            $car->quantidade_car += $request->quantidade_car;
        } else {
            // Se o produto não está no carrinho, crie uma nova entrada
            $car = new Car();

            $car->id_produto = $request->id;
            $car->id_usuario = auth()->user()->id;
            $car->quantidade_car = $request->quantidade_car;
            $car->cor_car = $request->cor_produto;
            $car->tamanho_car = $request->tamanho_roupa;
        }

        $valida2 = $this->validaQuantidade($car->quantidade_car,$request->id);

        if ($valida2) {
            return redirect()->back()->with('err', "Quantidade excedida. O máximo deste produto é {$valida2}.");
        }
        else {
            $car->save();
            return redirect('/cart')->with('msg', 'Produto adicionado no carrinho');
        }
    }
    public function edit_carrinho(Request $request){

        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }

        // Verificar se o produto já está no carrinho para o usuário atual
        $car = Car::where('id_produto', $request->id)
        ->where('id_usuario', auth()->user()->id)
        ->first();

        $car->quantidade_car = $request->quantidade_car;

        $valida = $this->validaQuantidade($car->quantidade_car,$request->id);

        if($valida){
            return "Quantidade excedida. O maximo deste produto é {$valida}.";
        }else{
            $car->save();
            $dados = parent::verificaUsuarioLog();
            return $dados;
        }
    }

    private function validaQuantidade($car_quantidade, $id_produto){
        
        $product = Product::find($id_produto);

        if($car_quantidade > $product->quantidade_estoq){
            return $product->quantidade_estoq;
        } 
        
        return false;
    }
    public function destroy_car($id){
        
        // Localize o produto
        $cart = Car::find($id);

        //Valida se o usuario dono do carrinho que está realizando a exclusão do produto
        if($cart->id_usuario == auth()->user()->id){
            $cart->delete();
            
            return redirect('/cart')->with('msg','Produto removido do carrinho!');
        }
          
        abort(403);//Acesso negado
    }
}