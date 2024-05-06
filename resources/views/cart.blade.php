@extends('layouts.main')

@section('title','cart')

@section('content')

    <!--=============== MAIN ===============-->
    <main class="main">
         <!--=============== SHOP ===============-->
         <section class="shop section container">
            <h2 class="breadcrumb__title">Carrinho</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Carrinho</span></h3>

            <div class="checkout__container grid">
                <div class="checksider__container">
                    <div class="out__prices">
                        <span class="out__prices-total">CARRINHO</span>
                    @if(isset($dados))
                        <span class="Out__prices-item"  id="quantidadeProdutosCart">{{ $dados['count'] }} Produtos</span>
                    </div>
                    @foreach ($dados['produtosNoCarrinho'] as $cart)
                    <div class="out__container">
                    <article class="out__card">
                        <div class="out__box">
                            <img src="/img/product/{{ $cart->imagem_produto }}" alt="" class="out__img">
                        </div>
                        <div class="out__details">
                            <h3 class="out__title">{{ $cart->nome_produto }}</h3>
                            <span class="out__price">{{ number_format($cart->valor_produto, 2, ',', '.') }}</span>
                            <input type="hidden" id="quantidadeCart{{ $cart->id }}" value="{{ $cart->quantidade_estoq }}">
        
                            <div class="out__amount">
                                <div class="out__amount-content">
                                    <span class="out__amount-box" onclick="countProductCart('-', {{ $cart->id }})">
                                        <i class="bx bx-minus"></i>
                                    </span>
        
                                    <span class="out__amount-number" id="CountProduct{{ $cart->id  }}">{{ $cart->quantidade_car }}</span>
                                    
                                    <span class="out__amount-box" onclick="countProductCart('+', {{ $cart->id }})">
                                        <i class="bx bx-plus"></i>
                                    </span>
                                    <p>{{$cart->cor_car}}</p>
                                    <p>{{$cart->tamanho_car}}</p>
                                </div>
                                <input type="hidden" name="quantidade_car" id="countProduct{{ $cart->id }}" value="{{ $cart->quantidade_car }}">
                                <input type="hidden" name="id" value="{{ $cart->id }}">
                                <form action="{{route('car.destroy', $cart->carrinho_id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bx bx-trash-alt out__amount-trash"></button>
                                </form>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
                <div class="checksider__container">
                    <h3 class="check__title">Checkout</h3>
                    <div class="filter__content">
                        <h3 class="check__subtitle">Subtotal</h3> <span id="subTotal">R$ {{ number_format($dados['subtotal'], 2, ',', '.') }}</span>
                        <h3 class="check__subtitle">Frete</h3> <span>R$ 20,00</span>
                        <h3 class="check__subtitle">Total</h3> <span id="totalValue">R$ {{ number_format($dados['subtotal'] + 20, 2, ',', '.') }}</span>
                    </div>
                @endif
                <br>
                <div style="display:flex; justify-content:center;">
                    <a href="/checkout" class="button">Confirmar Pedido</a>
               </div>
                </div>
            </div>
            <div class="checksider__container" style="height: fit-content">
                <div class="out__prices">
                    <span class="out__prices-total">ENDEREÇO DE ENTREGA</span>
                </div>
                @if (count($enderecos) > 0)
                    @foreach ($enderecos as $endereco)
                    <div class="out__container adress">
                        <div class="adress-head" style="letter-spacing: 0.5px; ">
                            <h4><strong>Endereço</strong></h4>
                            <input type="radio" id="endereco_selecionado" name="genero" value="endereco_selecionado" style="width:18px; height:18px">                   
                        </div>
                        <div class="adress_information">
                            <span>CEP: {{ $endereco->cep }}</span>
                            <span>Rua: {{ $endereco->rua }}</span>
                            <span>Número: {{ $endereco->number_house }}</span>
                            <span>Complemento: {{ $endereco->complemento }}</span>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span>Data de criação: {{ $endereco->created_at->format('d/m/Y') }}</span>
                                <a class="button" href="/endereco/edit/{{$endereco->id}}" style = "display: flex; width: 80px; align-items: center; justify-content: center; height: 23px;">Editar</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="out__container adress">
                    <div class="adress-head" style="letter-spacing: 0.5px;">
                        <h4>Nenhum endereço cadastrado</h4>
                    </div>
                </div>
                @endif
                <div class="adress-bottom">
                <a class="button btn-adress" href="/registro_end">Novo Endereço</a>
                </div>
            </div>
        </section>
    </main>

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up">
        <div class="bx bxs-up-arrow-alt scrollup__icon"></div>
    </a>
    
    <!--=============== SWIPER JS ===============-->
    <script src="/js/swiper-bundle.min.js"></script>

    <!--=============== JS ===============-->
    <script src="/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
        function countProductCart(operation, id){
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const subTotalElement = document.getElementById("subTotal");
            const totalValueElement = document.getElementById("totalValue");
            const quantidadeProdutosElement = document.getElementById("quantidadeProdutosCart");
            const countProduct = document.getElementById('countProduct'+id);
            const quantidadeProdutoElement = document.getElementById('CountProduct'+id);
            var quantidadeProduto = parseInt(quantidadeProdutoElement.textContent);
            var maxItens = parseInt(document.getElementById('quantidadeCart'+id).value);
            var opcoes = {
                style: 'currency',
                currency: 'BRL'
            }
            if(operation === '-'){
                quantidadeProduto -= 1; 
            }
            if(operation === '+'){
                quantidadeProduto += 1;
                if(quantidadeProduto > maxItens){
                    quantidadeProduto--;
                }
            }
            
            if(quantidadeProduto >= 1){
                quantidadeProdutoElement.textContent = quantidadeProduto;
                countProduct.value = quantidadeProduto;
            }else{
                quantidadeProduto = 1;
            }
            console.log(id+' '+quantidadeProduto);
            $.ajax({
                url: '/edit/car',
                type: 'POST',
                data: {'id': id,
                    'quantidade_car': parseInt(quantidadeProduto),
                    },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response){
                    console.log(response);
                    console.log(response['subtotal']);
                    subTotalElement.textContent = response['subtotal'].toLocaleString('pt-BR', opcoes);
                    quantidadeProdutosElement.textContent = response['count'] + " Produtos";
                    totalValueElement.textContent = (response['subtotal'] + 20).toLocaleString('pt-BR', opcoes);
                },
                error: function(xhr, status, error) {
                    console.log('erro');
                }
            });
            
        }
    </script>
@endsection