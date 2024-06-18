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
                    <div class="checkout__box">
                    @if(isset($dados))
                        @if(!empty($dados['produtosNoCarrinho']))
                            @foreach ($dados['produtosNoCarrinho'] as $cart)
                            <div class="out__card">
                                <div class="card__product flex">
                                    <img src="/img/product/{{ $cart->imagem_produto_1 }}" alt="" class="out__img">
                                    <div class="product__describe">
                                        <h3>{{ $cart->nome_produto }}</h3>
                                        <p>Descrição do produto</p>
                                    </div>
                                </div>
                                <div class="card__amount">
                                    <h3>Quantidade</h3>
                                    <div class="out__amount-content">
                                        <span class="out__amount-box" onclick="countProductCart('-', {{ $cart->id }})">
                                            <i class="bx bx-minus" ></i>
                                        </span>
            
                                        <span class="out__amount-number" id="CountProduct{{ $cart->id  }}">{{ $cart->quantidade_car }}</span>
                    
                                        <span class="out__amount-box" onclick="countProductCart('+', {{ $cart->id }})">
                                            <i class="bx bx-plus"></i>
                                        </span>
                                    </div>
                                    <input type="hidden" name="quantidade_car" id="countProduct{{ $cart->id }}" value="{{ $cart->quantidade_car }}">
                                    <input type="hidden" name="id" value="{{ $cart->id }}">
                                    <form action="{{route('car.destroy', $cart->carrinho_id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bx bx-trash-alt out__amount-trash"></button>
                                    </form>
                                </div>
                                <div class="card__product-price">
                                    <h3>Valor à vista</h3>
                                    <span>{{ number_format($cart->valor_produto, 2, ',', '.') }}</span>
                                    <input type="hidden" id="quantidadeCart{{ $cart->id }}" value="{{ $cart->quantidade_estoq }}">
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="out__card" style="border-bottom: unset">
                                <div class="empty__cart">
                                    <h3>Seu carrinho está vazio.</h3>
                                    <i class="fa-solid fa-cart-arrow-down"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="resume__container">
                    <div class="checkout_title">
                        <i class="fa-solid fa-receipt"></i>
                        <h3>Resumo</h3>
                    </div>
                    <div class="resume__content">
                        <div class="resume__subtotal border-bottom">
                            <h3>Itens</h3>
                            <span>{{ $dados['count'] }} Produtos</span>
                        </div>
                        <div class="resume__discount border-bottom">
                            <h3>Descontos Aplicados</h3>
                        </div>
                        <div class="resume__total">
                            <div class="resume__total-value">
                                <h2>Total</h2>
                                <span>RS {{ number_format($dados['subtotal'], 2, ',', '.') }}</span>
                            </div>
                            <div class="resume__btns">
                                @if(isset($dados))
                                <form method="POST" id="pedido-form" action="{{route('add.pedido')}}">
                                    @csrf
                                    <input type="hidden" id="numberExist" value="{{$numberExist}}">
                                    <input type="hidden" name="prod_carrinho" value="{{json_encode($dados['produtosNoCarrinho'])}}">
                                    <button type="submit" class="btn btn-resume" onclick="verificaNumero()">FINALIZAR</button>
                                </form>
                                @endif
                                <a class="btn btn-resume btn-return-shop" href="/shop">Voltar as compras</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>

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

        function verificaNumero() {
                event.preventDefault(); 
                let numberExist = $('#numberExist').val(); // Verifique como você está definindo esse valor

                if (numberExist == 0) {
                    Swal.fire({
                        title: "Entre com o seu número para continuar",
                        html: `
                            <div>
                                <label for="phone-input">Número de telefone:</label>
                                <input type="text" id="phone-input" class="swal2-input" placeholder="(99) 99999-9999">
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: "Salvar",
                        cancelButtonText: "Cancelar",
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            const inputPhoneNumber = $('#phone-input').val().replace(/\D/g, ''); // Remover caracteres não numéricos
                            
                            if (inputPhoneNumber.length !== 11) { // Verificar se o número de dígitos é válido
                                Swal.showValidationMessage("Por favor, insira um número de telefone válido.");
                                return false;
                            }

                            return inputPhoneNumber;
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            phoneNumber = result.value;
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'number_phone',
                                value: phoneNumber
                            }).appendTo('#pedido-form');

                            $('#pedido-form').submit();
                        }
                    });
                } else {
                    $('#pedido-form').submit();
                }    
        }

        function abrirModalTelefone() {
            Swal.fire({
                title: "Entre com o seu número para continuar o pedido",
                html: `
                    <div>
                        <label for="phone-input">Número de telefone:</label>
                        <input type="text" id="phone-input" class="swal2-input" placeholder="(__) _____-____">
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                didOpen: () => {
                    // Aplicar a máscara de telefone
                    Inputmask({
                        mask: '(99) 99999-9999',
                        placeholder: '(__) _____-____',
                        showMaskOnHover: false,
                        showMaskOnFocus: true
                    }).mask(document.getElementById('phone-input'));
                },
                preConfirm: async () => {
                    const phoneNumberInput = document.getElementById('phone-input');
                    const unmaskedPhoneNumber = phoneNumberInput.inputmask.unmaskedvalue(); // Obter o número sem a máscara
                    const phoneNumberPattern = /^[0-9]{10,11}$/; // Ajuste o regex conforme necessário para o formato do número de telefone

                    if (!phoneNumberPattern.test(unmaskedPhoneNumber)) {
                        Swal.showValidationMessage(`
                            Por favor, insira um número de telefone válido.
                        `);
                        return false;
                    }

                    try {
                        await savePhoneNumber(unmaskedPhoneNumber); // Chame a função para salvar o número de telefone sem a máscara
                    } catch (error) {
                        Swal.showValidationMessage(`
                            Falha ao salvar o número: ${error}
                        `);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Número de telefone salvo com sucesso!"
                    });
                }
            });
        }
    </script>
@endsection