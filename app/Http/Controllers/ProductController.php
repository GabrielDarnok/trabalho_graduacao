<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function store(Request $request){

        $valida = $this->validaNumeros($request->quantidade_estoq, $request->valor_produto);

        if ($valida === true) {
            $product = new Product;

            $product->nome_produto = $request->nome_produto;
            $product->descricao_produto = $request->descricao_produto;
            $product->valor_produto = $request->valor_produto;
            $product->quantidade_estoq = $request->quantidade_estoq;
            $product->tamanho_roupa = $request->tamanho_roupa;
            $product->cor_produto = $request->cor_produto;
            $product->categoria_produto = $request->categoria_produto;
        
            //image upload
        
            if($request->hasFile('imagem_produto') && $request->file('imagem_produto')->isValid()){
                
                $requestImage = $request->imagem_produto;
        
                $extension = $requestImage->extension();
        
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
                $request->imagem_produto->move(public_path('img/product'), $imageName);
        
                $product->imagem_produto = $imageName;
            }
            if($request->hasFile('imagem_produto_2') && $request->file('imagem_produto_2')->isValid()){
                
                $requestImage = $request->imagem_produto_2;
        
                $extension = $requestImage->extension();
        
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
                $request->imagem_produto_2->move(public_path('img/product'), $imageName);
        
                $product->imagem_produto_2 = $imageName;
            }
            if($request->hasFile('imagem_produto_3') && $request->file('imagem_produto_3')->isValid()){
                
                $requestImage = $request->imagem_produto_3;
        
                $extension = $requestImage->extension();
        
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
                $request->imagem_produto_3->move(public_path('img/product'), $imageName);
        
                $product->imagem_produto_3 = $imageName;
            }
            if($request->hasFile('imagem_produto_4') && $request->file('imagem_produto_4')->isValid()){
                
                $requestImage = $request->imagem_produto_4;
        
                $extension = $requestImage->extension();
        
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
                $request->imagem_produto_4->move(public_path('img/product'), $imageName);
        
                $product->imagem_produto_4 = $imageName;
            }
        
            $product->save();
            $produtcs = Product::all();
            
            return ['products' => $produtcs];
        } else {
            return redirect()->back()->with('err',"Valores inseridos estão incorretos.");
        }
    }

    private function validaNumeros($quantidade, $valor){
        if ($quantidade > 0 && $valor > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function destroy($id){
        
        // Localize o produto
        $product = Product::find($id);

        if ($product) {
            
            $imagePath = $product->imagem_produto;

            if (Storage::exists("img/product/$imagePath")) {
                Storage::delete("img/product/$imagePath");
            }

            $product->delete();
        }

        return redirect()->back()->with('msg', 'Produto removido com sucesso');
    }
    
    public function edit($id){

        $Product = product::findOrfail($id);

        return view('admin.edit', ['Product' => $Product]);
    }

    public function update(Request $request){
        
        $valida = $this->validaNumeros($request->quantidade_estoq, $request->valor_produto);

        if ($valida === true) {
        
            //Juntando os dados do request

            $dados = $request->all();
            if (isset($dados['tamanho_roupa']) && is_array($dados['tamanho_roupa'])) {
                $tamanhos = implode(',', $dados['tamanho_roupa']);
                $dados['tamanho_roupa'] = $tamanhos;
            }
            if (isset($dados['cor_produto']) && is_array($dados['cor_produto'])) {
                $tamanhos = implode(',', $dados['cor_produto']);
                $dados['cor_produto'] = $tamanhos;
            }

            //image upload update

            if($request->hasFile('imagem_produto') && $request->file('imagem_produto')->isValid()){
                
                $requestImage = $request->imagem_produto;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
                $request->imagem_produto->move(public_path('img/product'), $imageName);

                $dados ['imagem_produto'] = $imageName;
            }
            if($request->hasFile('imagem_produto_2') && $request->file('imagem_produto_2')->isValid()){
                
                $requestImage = $request->imagem_produto_2;
        
                $extension = $requestImage->extension();
        
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
                $request->imagem_produto_2->move(public_path('img/product'), $imageName);
        
                $dados ['imagem_produto_2'] = $imageName;
            }
            if($request->hasFile('imagem_produto_3') && $request->file('imagem_produto_3')->isValid()){
                
                $requestImage = $request->imagem_produto_3;
        
                $extension = $requestImage->extension();
        
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
                $request->imagem_produto_3->move(public_path('img/product'), $imageName);
        
                $dados ['imagem_produto_3'] = $imageName;
            }
            if($request->hasFile('imagem_produto_4') && $request->file('imagem_produto_4')->isValid()){
                
                $requestImage = $request->imagem_produto_4;
        
                $extension = $requestImage->extension();
        
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
                $request->imagem_produto_4->move(public_path('img/product'), $imageName);
        
                $dados ['imagem_produto_4'] = $imageName;
            }


            product::FindOrFail($request->id)->update($dados);

            return redirect('/admin')->with('msg', 'Editado com sucesso!');
        } else {
            return redirect()->back()->with('err',"Valores inseridos estão incorretos.");
        }
    }

    public function busca_product(Request $request){
        $busca = $request->search;
        $tamanhos = $request->tamanhos;
        $estilos = $request->estilos;
        $categorias = $request->categorias;
        
        $message = 'Nenhum produto encontrado com os critérios de busca :(';
        
        $query = Product::query();

        if (!empty($busca)) {
            $query->where('nome_produto', 'like', '%' . $busca . '%');
        }
        
        if (!empty($tamanhos)) {
            $query->where(function ($subquery) use ($tamanhos) {
                foreach ($tamanhos as $tamanho) {
                    $subquery->orWhere('tamanho_roupa', 'like', '%' . $tamanho . '%');
                }
            });
        }
        if (!empty($estilos)) {
            $query->whereIn('categoria_produto', $estilos);
        }
        if (!empty($categorias)) {
            if (in_array('-', $categorias)){               
                $query->orderBy('valor_produto', 'asc'); //menor preço
            }
            if (in_array('+', $categorias)){              
                $query->orderBy('valor_produto', 'desc'); //maior preço
            }
        }
        $products = $query->paginate(4);
        
        if ($products->isEmpty()) {
            return ['message' => $message];
        }
        return ['products' =>$products];
    }

    public function show_product($id){

        $Product = product::findOrfail($id);

        $Products = product::all();

        //Faz a consulta se o usuario está logado e retorna o $dados com os produtos do carrinho
        $dados = parent::verificaUsuarioLog();

        return view('details', ['Product' => $Product , 'Products' => $Products, 'dados' => $dados]);

    }
}
