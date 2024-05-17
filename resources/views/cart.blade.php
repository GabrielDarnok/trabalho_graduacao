@extends('layouts.main')

@section('title','cart')

@section('content')

    <!--=============== MAIN ===============-->
    <main class="main">
         <!--=============== SHOP ===============-->
         <section class="shop section container">
            <h2 class="breadcrumb__title">Carrinho</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Carrinho</span></h3>

            <div class="checkout__container">
                <div class="checksider__container">
                    <div class="checkout_title">
                        <i class='bx bxs-package'></i>
                        <h3>Produtos</h3>
                    </div>
                    <!-- <div class="out__prices">
                        <span class="out__prices-total">CARRINHO</span>
                    @#if(isset($dados))
                        <span class="Out__prices-item"  id="quantidadeProdutosCart">{{ $dados['count'] }} Produtos</span>
                    </div>
                    @foreach ($dados['produtosNoCarrinho'] as $cart)
                    <div class="out__container">
                    <article class="out__card">
                        <div class="out__box"> 
                            <img src="/img/product/{{ $cart->imagem_produto_1 }}" alt="" class="out__img">
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
                        @if($dados['subtotal'] != 0)
                            <h3 class="check__subtitle">Total</h3> 
                            <span id="totalValue">R$ {{ number_format($dados['subtotal'], 2, ',', '.') }}</span>
                            <br>
                            <div style="display:flex; justify-content:center;">
                                <a href="/message" class="button">Confirmar Pedido</a>
                            </div>
                        @else
                            <h3 class="check__subtitle">Ops</h3> 
                            <span id="totalValue">Você ainda não tem itens adicionados. Deseja ir as compras ? <a href="/shop" class="btn">Produtos</a></span>
                        @endif
                    </div> -->
                    <div class="out__card">
                        <div class="card__product flex">
                            <img src="/img/product/20333fb253abb4f1cd5aa2005899661e.jpg" alt="" class="out__img">
                            <div class="product__describe">
                                <h3>Nome do produto</h3>
                                <p>Descrição do produto</p>
                            </div>
                        </div>
                        <div class="card__amount">
                            <h3>Quantidade</h3>
                            <div class="out__amount-content">
                                <span class="out__amount-box">
                                    <i class="bx bx-minus"></i>
                                </span>
    
                                <span class="out__amount-number" id="CountProduct{{ $cart->id  }}">2</span>
            
                                <span class="out__amount-box">
                                    <i class="bx bx-plus"></i>
                                </span>
                            </div>
                            <button type="submit" class="bx bx-trash-alt out__amount-trash"></button>
                        </div>
                        <div class="card__product-price">
                            <h3>Valor à vista</h3>
                            <span>R$ 1000,00</span>
                        </div>
                    </div>
                    @if(isset($dados))
                    @foreach ($dados['produtosNoCarrinho'] as $cart)
                    <div class="out__card">
                        <div class="card__product flex">
                            <img src="/img/product/20333fb253abb4f1cd5aa2005899661e.jpg" alt="" class="out__img">
                            <div class="product__describe">
                                <h3>{{$cart->nome_produto}}</h3>
                                <p>{{$cart->descricao_produto}}</p>
                            </div>
                        </div>
                        <div class="card__amount">
                            <h3>Quantidade</h3>
                            <div class="out__amount-content">
                                <span class="out__amount-box">
                                    <i class="bx bx-minus"></i>
                                </span>
    
                                <span class="out__amount-number" id="CountProduct{{ $cart->id  }}">{{ $cart->quantidade_car }}</span>
            
                                <span class="out__amount-box">
                                    <i class="bx bx-plus"></i>
                                </span>
                            </div>
                            <form action="{{route('car.destroy', $cart->carrinho_id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bx bx-trash-alt out__amount-trash"></button>
                            </form>
                        </div>
                        <div class="card__product-price">
                            <h3>Valor à vista</h3>
                            <span>R$ {{ number_format($cart->valor_produto, 2, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
                @endif
                </div>
                <div class="resume__container">
                    <div class="checkout_title">
                        <i class="fa-solid fa-receipt"></i>
                        <h3>Resumo</h3>
                    </div>
                    <div class="resume__content">
                        <div class="resume__subtotal border-bottom">
                            <h3>Subtotal</h3>
                            <span>R$ 19,00</span>
                        </div>
                        <div class="resume__discount border-bottom">
                            <h3>Descontos Aplicados</h3>
                        </div>
                        <div class="resume__total">
                            <div class="resume__total-value">
                                <h2>Total</h2>
                                <span>RS 19,99</span>
                            </div>
                            <div class="resume__btns">
                                <!-- <button class="btn">COMPRAR</button>
                                <button class="btn">Voltar as compras</button> -->
                            </div>
                        </div>
                    </div>
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
                    
                    quantidadeProdutosElement.textContent = response['count'] + " Produtos";
                    totalValueElement.textContent = (response['subtotal']).toLocaleString('pt-BR', opcoes);
                },
                error: function(xhr, status, error) {
                    console.log('erro');
                }
            });
            
        }
    </script>
@endsection