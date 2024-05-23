<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Product;
use App\Models\Pedido;

class CarrinhoController extends Controller
{
    public function add_carrinho(Request $request){
        
        $dados = parent::verificaUsuarioLog();

        if ($dados === null) {
            return redirect()->back()->with('err', 'É preciso estar logado para acessar esta página.');
        }
        // Verificar se o produto já está no carrinho para o usuário atual
        $car = Car::where('id_produto', $request->id)
        ->where('id_usuario', auth()->user()->id)->first();

        if ($car) {    
            // Se o produto já está no carrinho, atualize a quantidade
            $car->quantidade_car += $request->quantidade_car;
        } else {
            // Se o produto não está no carrinho, crie uma nova entrada
            $car = new Car();

            $car->id_produto = $request->id;
            $car->id_usuario = auth()->user()->id;
            $car->quantidade_car = $request->quantidade_car;
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
    public function finalizaPedido(Request $request){
        $prod_carrinho = json_decode($request->input('prod_carrinho'), true);

        // Verifique se recebeu algum ID de carrinho
        if (empty($prod_carrinho)) {
            abort(403, 'Acesso negado: nenhum carrinho encontrado.');
        }
        // Processar cada item do carrinho
        foreach ($prod_carrinho as $item) {
            // Acessar as informações do carrinho
            $cart = Car::find($item['carrinho_id']);
            if ($cart) {
                // Salvar os dados do carrinho no banco de dados
                $pedido = new Pedido();
                $pedido->id_usuario = $cart->id_usuario;
                $pedido->nome_produto = $item['nome_produto'];
                $pedido->quantidade_car = $item['quantidade_car'];
                $pedido->valor_produto = $item['valor_produto'];
                $pedido->valor_total = $item['valor_produto'] * $item['quantidade_car'];
                $pedido->imagem_produto_1 = $item['imagem_produto_1'];
                // Preencha outros campos de $pedido com os dados necessários
                $pedido->save();

                // Excluir o carrinho após salvar o pedido
                $cart->delete();
            } else {
                // Se algum carrinho não for encontrado, você pode decidir o que fazer
                // Exemplo: continue, lançar uma exceção, etc.
                continue;
            }
        }

        // Retornar uma resposta adequada ao cliente
        return redirect('/cart')->with('msg','Pedido realizado!');
    }
}