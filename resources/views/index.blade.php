@extends('layouts.main')

@section('title','index')

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
                                    <a href="/shop" class="button">Comprar Agora</a>
                                    <a href="/shop" class="button--link button--flex">Ver Detalhes <i class="bx bx-right-arrow-alt button__icon">
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
                                <div class="home__indicator"></div>
            
                                <div class="home__details-img">
                                    <h4 class="home__details-title">Moletom Sólido Cropped</h4>
                                    <div class="span home__details-subtitle">You Matter</div>
                                </div>
                            </div>
            
                            <div class="home__data">
                                <h1 class="home__title">VENHA NOS VISITAR</h1>
                                <p class="home__description">Av. Augusta Diogo Ayala, 500 - Jardim Bom Retiro (Nova Veneza), Sumaré.
                                </p>
            
                            </div>
                        </div>
                    </section>
            
                    <!--Slide 3 aqui-->
                    <!-- <section class="swiper-slide">
                        <div class="home__content grid">
                            <div class="home__group">
                                <img src="/img/slide-1.png" alt="" class="home__img">
                                <div class="home__indicator"></div>
            
                                <div class="home__details-img">
                                    <h4 class="home__details-title">Calça Jeans Cargo Denim</h4>
                                    <div class="span home__details-subtitle">You Matter</div>
                                </div>
                            </div>
            
                            <div class="home__data">
                                <h3 class="home__subtitle">ITEM POPULAR</h3>
                                <h1 class="home__title">ANDE COM ESTILO COM A GENTE!</h1>
                                <p class="home__description">Criado para usar no dia a dia ou naquela saida com as amigas, você irá se destacar a onde você esteja.</p>
            
                                <div class="home__buttons">
                                    <a href="/shop" class="button">Comprar Agora</a>
                                    <a href="/shop" class="button--link button--flex">Ver Detalhes <i class="bx bx-right-arrow-alt button__icon">
                                    </i></a>
                                </div>
            
                            </div>
                        </div>
                    </section> -->
                </div>
                <div class="swiper-pagination"></div>
              </div>
        </section>

        <section class="discount section">
            <div class="categories__container container">
              <div>Ferramentas</div>
              <div>Materias de construção</div>
              <div>Pregos e parafusos</div>
              <div>Diversos</div>
            </div>
        </section>
        <!--=============== DISCOUNT ===============-->
        <section class="discount section">
            <div class="categories__container container">
                <img src="/img/discount.png" alt="" class="discount__img">

                <div class="discount__data">
                    <h2 class="discount__title">5% de Desconto <br> Em Pagamentos Via Pix!</h2>
                    <a href="/shop" class="button">Ir as Compras</a>
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
                                <img src="/img/product/{{ $product->imagem_produto }}" alt="" class="new__img">
                            </a>
                            <h3 class="new__title">{{ $product->nome_produto }}</h3>
                            <span class="new__subtitle">You Matter</span>

                            <div class="new__prices">
                                <span class="new__price">{{ number_format($product->valor_produto, 2, ',', '.') }}</span>
                            </div>

                            <a href="/shop/product/{{ $product->id }}" class="button new__button">
                                 <i class="bx bx-cart-alt new__icon"></i>
                            </a>
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
                <h2 class="section__title">Como encomendar <br> do shop!</h2>

                <div class="steps__container grid">
                    <!--PASSO 1-->
                    <div class="steps__card">
                        <div class="steps__card-number">01</div>
                        <h3 class="steps__card-title">Escolha Um Produto</h3>
                        <p class="steps__card-description">
                            Temos uma variedade de produtos a sua escolha e disposição, esperamos sua compra :)
                        </p>
                    </div>

                    <!--PASSO 2-->
                    <div class="steps__card">
                        <div class="steps__card-number">02</div>
                        <h3 class="steps__card-title">Faça Um Pedido</h3>
                        <p class="steps__card-description">
                            Assim que seu pedido for confirmado, nós iremos para o próximo passo que é o envio!
                        </p>
                    </div>

                    <!--PASSO 3-->
                    <div class="steps__card">
                        <div class="steps__card-number">03</div>
                        <h3 class="steps__card-title">Entrega</h3>
                        <p class="steps__card-description">
                            Enviaremos seu produto no mesmo dia, em pouco tempo você o terá diretamente na sua casa!
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!--=============== NEWS ===============-->
        <section class="newsletter section">
            <div class="newsletter__container container">
                <h2 class="section__title">Newsletter</h2>
                <p class="newsletter__description">
                    Fique por dentro de promoções, novas coleções ou novos produtos. Apenas cadastrando o seu Email.
                </p>

                <form action="" class="newsletter__form">
                    <input type="email" placeholder="Digite seu email..." class="newsletter__input">
                    <button class="button">Inscrever</button>
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