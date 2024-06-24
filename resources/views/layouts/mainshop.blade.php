<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/img/logo_zap.png" type="image/x-icon">
    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!--=============== FONTAWESOME===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="/css/swiper-bundle.min.css">
    

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/colors/color-1.css">

    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <div class="nav container">
            <a href="/" class="nav__logo">
                <img src="/img/logo_zap.png" alt="Zapolla">
            </a>
            
            <div class="nav__search-box">
                <div style="display: flex; justify-content: space-between; width: 100%">
                    <input class="input" style="border: black; width: 18rem" name="search" value="{{$busca}}" placeholder="O que procura na Zapolla?" id="valorPesquisa" oninput="productFilter('atual')">
                    <button style="background: white;" onclick="productFilter()">
                        <img src="/img/loupe.png" alt="lupa" height="20" width="20">
                    </button>
                </div>
            </div>

            <div class="nav__btns">
                @guest
                <div class="login__toggle" id="login-toggle">
                    <i class='bx bxs-user'></i>
                </div>
                @endguest
                @auth
                <div>
                    <i class="bx bxs-user" class="user__pic" id="userPic"> </i> 
                </div>
                <div class="sub-menu-wrap" id="subMenu">

                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="/img/profile-pic.png">
                            <h3> {{ auth()->user()->name }} </h3>
                        </div>
                        <hr>                       
                        @auth
                        @if(auth()->user()->role == "admin")
                            <a href="/dashboard_admin" class="sub-menu-link">
                                <i class="bx bx-cog"> </i>
                                <p>Admin page</p>
                            </a>
                        </li>
                        @endif
                        @endauth
                        <a href="/pedido" class="sub-menu-link">
                            <i class="bx bx-package"> </i>
                            <p>Meus Pedidos</p>
                        </a>
                        <form action="/logout" method="POST" class="sub-menu-link">
							@csrf
							<a href="/pedido" class="sub-menu-link" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bx bx-log-out" style="background: var(--first-color); color: white"> </i>
                                <p>Sair</p>
                            </a>
						</form>
                    </div>
                </div>

                <div class="nav__shop" id="cart-shop">
                    <i class='bx bxs-cart' ></i>
                </div>
                @endauth

                <div class="nav__toggle" id="nav-toggle">
                    <i class="bx bx-grid-alt"> </i>
                </div>

                <div>
                    <img src="/img/moon.png" id="moon">
                </div>

            </div>
        </div>
        <div class="nav__underline-brand"></div>
        <nav class="nav__list-row">
            <ul class="main-list container">
                <li>
                    <a href="{{ route('shop', ['search' => 'Ferramentas']) }}">Ferramentas<i class='bx bxs-chevron-down'></i></a>
                    <ul class="secondary-list">
                        <li><a href="{{ route('shop', ['search' => 'Furadeira']) }}">Furadeira</a></li>
                        <li><a href="{{ route('shop', ['search' => 'Martelete']) }}">Martelete</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('shop', ['search' => 'Chuveiro']) }}">Chuveiros<i class='bx bxs-chevron-down'></i></a>
                    <ul class="secondary-list">
                        <li><a href="{{ route('shop', ['search' => 'Ducha']) }}">Ducha</a></li>
                        <li><a href="{{ route('shop', ['search' => 'Chuveiro elétrico']) }}">Chuveiro elétrico</a></li>
                        <li><a href="{{ route('shop', ['search' => 'Chuveiro a gás']) }}">Chuveiro a gás</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('shop', ['search' => 'Porta']) }}">Portas<i class='bx bxs-chevron-down'></i></a>
                    <ul class="secondary-list">
                        <li><a href="{{ route('shop', ['search' => 'Porta de madeira']) }}">Portas de madeira</a></li>
                        <li><a href="{{ route('shop', ['search' => 'Porta de vidro']) }}">Portas de vidro</a></li>
                        <li><a href="{{ route('shop', ['search' => 'Porta de alumínio']) }}">Portas de alumínio</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('shop', ['search' => 'Materiais']) }}">Pregos e Parafusos<i class='bx bxs-chevron-down'></i></a>
                    <ul class="secondary-list">
                        <li><a href="{{ route('shop', ['search' => 'Prego']) }}">Pregos</a></li>
                        <li><a href="{{ route('shop', ['search' => 'Parafusos']) }}">Parafusos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('shop', ['search' => 'construção']) }}">Materiais de Construção<i class='bx bxs-chevron-down'></i></a>
                    <ul class="secondary-list">
                        <li><a href="{{ route('shop', ['search' => 'Cimento']) }}">Cimento</a></li>
                        <li><a href="{{ route('shop', ['search' => 'Argamassa']) }}">Argamassa</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('shop', ['search' => '']) }}">Diversos</a></li>
            </ul>
        </nav>
    </header>
    <!--=============== CART ===============-->
    <div class="cart" id="cart">
        <i class="bx bx-x cart__close" id="cart-close"></i>
        
        <h2 class="cart__title-center">Carrinho</h2>

        @if (isset($dados))
        <div class="cart__container">
            @foreach ($dados['produtosNoCarrinho'] as $cart)
            <article class="cart__card">
                <div class="cart__box">
                    <img src="/img/product/{{$cart->imagem_produto_1}}" alt="" class="cart__img">
                </div>
                <div class="cart__details">
                    <h3 class="cart__title">{{$cart->nome_produto}}</h3>
                    <span class="cart__price">{{ number_format($cart->valor_produto, 2, ',', '.') }}</span>
                    <div class="cart__amount">
                        <div class="cart__amount-content">
                            <span class="cart__amount-number">Quantidade: {{ $cart->quantidade_car }}</span>
                        </div>   
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="cart__prices">
            <span class="cart__prices-item" id="quantidadeProdutos">{{ $dados['count'] }} Produtos</span>
            <span class="cart__prices-total" id="total">Total R$ {{ number_format($dados['subtotal'], 2, ',', '.') }}</span>
        </div>
        <div class="carrinho">
            <a class="button" href="/cart">Ver detalhes</a>
        </div>
        @else
        <div class="cart__container">
            <div style="display: flex; justify-content: center;">Carrinho vazio!</div> 
        </div>
        <div class="cart__prices">
            <span class="cart__prices-item">0 Produtos</span>
            <span class="cart__prices-total">Total R$ 0</span>
        </div>
        @endif
    </div>
    <!--=============== LOGIN ===============-->
    <div class="login" id="login">
        <i class="bx bx-x login__close" id="login-close"></i>

        <h2 class="login__title-center">Login</h2>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('login') }}" class="login__form grid">
            @csrf
            <div class="login__content">
                <label for="email" value="{{ __('Email') }}" class="login__label">Email</label>
                <input id="email" class="login__input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
            </div>

            <div class="login__content">
                <label for="password" value="{{ __('Password') }}" class="login__label">Senha</label>
                <input id="password" class="login__input" type="password" name="password" required autocomplete="current-password">
            </div>
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
                </label>
            </div>
            <div>
                <button type="submit" class="button" onclick="verifyLogin()">Entrar</button>
            </div>

            <div>
                <p class="signup">Nãe é cadastrado? <a href="/cadastroPage">Cadastrar-se agora.</a></p>
                <p class="signup">Esqueceu a senha? <a href="/forgot_password">Clique aqui.</a></p>
            </div>
        </form>
    </div>

    <main class="main-content"> 
        @if(session('msg'))
        <input type="hidden" id="msg" value="{{ session('msg') }}">
        <script>
            var mensagem = document.getElementById('msg').value;
            if (mensagem) {
                Swal.fire(
                    'Sucesso!',
                    mensagem,
                    'success'
                );
                <?php session(['msg' => null]); ?>
            }
        </script>
        @elseif(session('err')) 
        <input type="hidden" id="msg" value="{{ session('err') }}">
        <script>
            var mensagem = document.getElementById('msg').value;
            if(mensagem){
                Swal.fire(
                    'Opa!',
                    mensagem,
                    'error'
                );
                <?php session(['err' => null]); ?>
                console.log('Mensagem definida como nula na sessão');
            }
        </script>         
        @endif
    @yield ('content')
    
    </main>
    <!--=============== FOOTER ===============-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <!--FOOTER CONTEUDO 1-->
            <div class="footer__content">
                <h3>
                <a class="footer__logo">
                    <i class="bx bxs-shopping-bags footer__logo-icon"></i>Zapolla
                </a>
                </h3>
                <p class="footer__description">Aproveite <br> as compras!</p>

                <div class="footer__social">
                    <a href="https://www.instagram.com/comercialzapolla/" class="footer__social-link" target="_blank"><i class="bx bxl-instagram"></i></a>
                </div>
            </div>

            <!--FOOTER CONTEUDO 2-->
            <div class="footer__content">
                <h3 class="footer__tittle" style="color:var(--text-color);">Sobre</h3>

                <ul class="footer__links">
                    <li><a href="/contato" class="footer__link">Fale Conosco</a></li>
                </ul>
            </div>

            <!--FOOTER CONTEUDO 3-->
            <div class="footer__content">
                <h3 class="footer__tittle" style="color:var(--text-color);">Nossos Serviços</h3>

                <ul class="footer__links">
                    <li><a href="/shop" class="footer__link">Shop</a></li>
                    <li><a href="/" class="footer__link">Como comprar</a></li>
                </ul>
            </div>

            <!--FOOTER CONTEUDO 4-->
            <div class="footer__content">
                <h3 class="footer__tittle" style="color:var(--text-color);">Nossa Empresa</h3>

                <ul class="footer__links">
                    <li><a href="/sobre" class="footer__link">Quem Somos</a></li>
                    <li><a href="/cadastroPage" class="footer__link">Registro</a></li>
                </ul>
            </div>
        </div>
       <span class="footer__copy">&#169; Fatec Campinas Developer Team. All rights reserved.</span>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>        
        function countProduct(operation, id){
            const quantidadeProdutos = document.getElementById('quantidadeProdutos');
            const countProduct = document.getElementById('countProductMain'+id);
            const quantidadeProdutoElement = document.getElementById('CountProductMain'+id);
            const totalElement = document.getElementById('quantidadeProdutos');
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var maxItens = parseInt(document.getElementById('quantidadeCart'+id).value);
            var opcoes = {
                style: 'currency',
                currency: 'BRL'
            }

            if(quantidadeProdutoElement){
                var quantidadeProduto = parseInt(quantidadeProdutoElement.textContent);

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
                        total.textContent = "Total " + response['subtotal'].toLocaleString('pt-BR', opcoes);
                        quantidadeProdutos.textContent = response['count'] + " Produtos";
                    },
                    error: function(xhr, status, error) {
                        console.log('erro');
                    }
                });
            }
            
            
        }
    </script>
