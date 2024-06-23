@extends('layouts.main')

@section('title','Zapolla - Home')

@section('content')

    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== HOME ===============-->
        <section class="home container">
            <div class="swiper home-swiper">
                <div class="swiper-wrapper">
                    <!--Slide 1 aqui-->
                    <section class="swiper-slide">
                        <div class="home__content grid">
                            <div class="home__group">
                                <img src="/img/carrinho.jpg" alt="" class="home__img">
                                <!-- <div class="home__indicator"></div>
            
                                <div class="home__details-img">
                                    <h4 class="home__details-title">Cardigã de textura sólida</h4>
                                    <div class="span home__details-subtitle">You Matter</div>
                                </div> -->
                            </div>
            
                            <div class="home__data">
                                <h3 class="home__subtitle">PROMOÇÃO</h3>
                                <h1 class="home__title">APROVEITEM! ULTIMAS UNIDADES!</h1>
                                <p class="home__description">CARRINHO DE MÃO por apenas R$249,90</p>
            
                                <div class="home__buttons">
                                    <a href="{{ route('shop', ['search' => 'Carrinho de mão']) }}" class="button">Comprar Agora</a>
                                    <a href="{{ route('shop', ['search' => 'Carrinho de mão']) }}" class="button--link button--flex">Ver Detalhes <i class="bx bx-right-arrow-alt button__icon">
                                    </i></a>
                                </div>
            
                            </div>
                        </div>
                    </section>
            
                    <!--Slide 2 aqui-->
                    <section class="swiper-slide">
                        <div class="home__content grid">
                            <div class="home__group">
                                <img src="/img/loja.jpg" alt="" class="home__img">
                            </div>
            
                            <div class="home__data">
                                <h1 class="home__title">VENHA NOS VISITAR</h1>
                                <p class="home__description">Av. Augusta Diogo Ayala, 500 - Jardim Bom Retiro (Nova Veneza), Sumaré.
                                </p>
            
                            </div>
                        </div>
                    </section>
                </div>
                <div class="swiper-pagination"></div>
              </div>
        </section>

        <section class="discount section">
            <h2 class="section__title"> Seleção de categorias</h2>
            <div class="categories__container container">
              <div class="steps__card">
                <div class="icon__card">
                    <a href="{{ route('shop', ['search' => 'Martelo']) }}"><i class="fa-solid fa-hammer"></i></a>
                </div>
                <h3>Ferramentas</h3>
              </div>
              <div class="steps__card">
                <div class="icon__card">
                    <a href="{{ route('shop', ['search' => 'Construção']) }}"><i class="fa-solid fa-trowel-bricks"></i></a>
                </div>
                <h3>Materias de construção</h3>
              </div>
              <div class="steps__card">
                    <div class="icon__card">
                        <a href="{{ route('shop', ['search' => 'Prego']) }}"><i class="fa-solid fa-screwdriver"></i></a>
                    </div> 
                    <h3>Pregos e parafusos</h3>
                    </div>
                    <div class="steps__card">
                        <div class="icon__card">
                            <a href="{{ route('shop', ['search' => '']) }}"><i class="fa-solid fa-ellipsis"></i></a>
                        </div>  
                        <h3>Diversos</h3>
                    </div>
            </div>
        </section>

        <!--=============== NEW COLECTION ===============-->
        <section class="new section">
            <h2 class="section__title"> Alguns dos nossos produtos</h2>

            <div class="new__container container">
                <div class="swiper new-swiper">
                    <div class="swiper-wrapper">
                        @if(isset($products))
                        @foreach ($products as $product)
                        <div class="new__content swiper-slide">
                            <div class="new__tag">Novo</div>
                            <a href="/shop/product/{{ $product->id }}">
                                <img src="/img/product/{{ $product->imagem_produto_1 }}" alt="" class="new__img">
                            </a>
                            <h3 class="new__title">{{ $product->nome_produto }}</h3>
                            <span class="new__subtitle">{{ $product->descricao_produto }}</span>

                            <div class="new__prices">
                                <span class="new__price"> R$ {{ number_format($product->valor_produto, 2, ',', '.') }}</span>
                            </div>

                            <a href="/shop/product/{{ $product->id }}" class="button new__button">
                                 <i class="bx bx-cart-alt new__icon"></i>
                            </a>

                            <a href="/shop/product/{{ $product->id }}"><button class="button product__btn">COMPRAR</button></a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!--=============== STEPS ===============-->
        <section class="steps section container" id="stepslink">
            <div class="steps__bg">
                <img src="img/promo_1.jpg" alt="promoção 1">
                <img src="img/promo_2.jpg" alt="promoção 2">
            </div>
        </section>

        <!--=============== NEWS ===============-->
        <section class="newsletter section">
            <div class="newsletter__container container">
                <h2 class="section__title">Newsletter</h2>
                <p class="newsletter__description">
                    Fique por dentro de promoções, novas coleções ou novos produtos. Apenas informando seu numero.
                </p>

                <form action="{{ route('add.phone')}}" method="POST" class="newsletter__form">
                    @csrf
                    <input type="text" name="number_phone" placeholder="Digite seu numero de telefone..." class="newsletter__input" pattern="[0-9]*" required>
                    <button class="button">Enviar</button>
                </form>
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

@endsection