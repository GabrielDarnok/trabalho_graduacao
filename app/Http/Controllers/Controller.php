<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Car;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function consultaCarrinho(){
        
        $carrinho = Car::where('id_usuario', auth()->user()->id)->get();
            
        //Atribuir os valores encontrados em um array
        $produtosNoCarrinho = [];

        //Retorna o valor do que está no carrinho
        $subtotal = 0;

        //valores para o pedido
        $idsDosProdutos = [];
        $tamanhoProdutos = [];
        $corProdutos = [];
        $quantidadeProdutos = [];
        $carrinho_id = [];

        // Acesse os produtos relacionados a partir dos registros do carrinho
        foreach ($carrinho as $item) {
            $produto = $item->produto;
            $produto->carrinho_id = $item->id; // Adicione o ID do carrinho ao objeto de produto para poder ser referenciado na view
            $produto->quantidade_car = $item->quantidade_car;
            $produto->cor_car = $item->cor_car;
            $produto->tamanho_car = $item->tamanho_car;
            $produtosNoCarrinho[] = $produto;

            //Salvando os valores separados para o pedido
            $idsDosProdutos[] = $produto->id;
            $tamanhoProdutos[] = $produto->tamanho_car;
            $corProdutos[] = $produto->cor_car;
            $quantidadeProdutos[] = $produto->quantidade_car;
            $carrinho_id[] = $item->id;

            $subtotal += $produto->valor_produto * $item->quantidade_car;
        }
        
        //Retorna a quantidade de produtos no carrinho
        $count = Car::where('id_usuario', auth()->user()->id)->sum('quantidade_car');

        return (['produtosNoCarrinho' => $produtosNoCarrinho, 'count' => $count, 'subtotal' => $subtotal, 'carrinho' => $carrinho, 'idsDosProdutos' => $idsDosProdutos, 'tamanhoProdutos' => $tamanhoProdutos, 'corProdutos' => $corProdutos, 'quantidadeProdutos' => $quantidadeProdutos, 'carrinho_id' => $carrinho_id]);
    }
    
        public function verificaUsuarioLog(){
        
        if(isset(auth()->user()->id)){
            return $this->consultaCarrinho();
        } else {
            return null;
        }
    }
}
