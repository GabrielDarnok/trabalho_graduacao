@extends('layouts.main')

@section('title','Zapolla - Detalhes')

@section('content')
    <style>
    select{
        -webkit-appearance:none;
        -moz-appearance:none;
        -ms-appearance:none;
        appearance:none;
        outline:0;
        box-shadow:none;
        border:0!important;
        background: #f27474;
        background-image: none;
        flex: 1;
        padding: 0 .5em;
        color:#fff;
        cursor:pointer;
        font-size: 1em;
        font-family: 'Open Sans', sans-serif;
        border-radius: .25em;
    }
    select::-ms-expand {
        display: none;
    }
    </style>
    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== DETAILS ===============-->
        <section class="shop section container">
            <h2 class="breadcrumb__title">Detalhes</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Detalhes</span></h3>

            <div class="details__container grid">
                <div class="swiper home-swiper" style="width: 500px;">
                    <div class="swiper-wrapper">
                        @for($i = 1; $i <= 4; $i++)
                            @if(isset($Product->{"imagem_produto_$i"}))
                                <section class="swiper-slide">
                                    <img src="/img/product/{{ $Product->{"imagem_produto_$i"} }}" class="d-block w-100" alt="...">
                                </section>
                            @endif
                        @endfor    
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @for($i = 1; $i <= 4; $i++)
                            @if(isset($Product->{"imagem_produto_$i"}))
                                <div class="carousel-item {{ $i === 1 ? 'active' : '' }}">
                                    <img src="/img/product/{{ $Product->{"imagem_produto_$i"} }}" class="d-block w-100" alt="...">
                                </div>
                            @endif
                        @endfor
                    </div>
                    @if($i > 2)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div> -->

                <div class="product__info">
                    <h3 class="details__subtitle">{{ $Product->nome_produto }}</h3>
                    <p class="details__title">Zapolla</p>

                    <div class="rating">
                        <div class="stars">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bx-star"></i>
                        </div>
                        <span class="reviews__count">... opniões sobre o produto.</span>
                    </div>

                    <div class="details__prices">
                        <span class="details__price">R$ {{ number_format($Product->valor_produto, 2, ',', '.') }}</span>
                    </div>

                    <div class="details__description">
                        <h3 class="description__tittle">Detalhes do Produto</h3>
                        <div class="description__details">
                            <p>{{ $Product->descricao_produto }}</p>
                            <!--Desatativado por tempo indeterminado.
                            <p>Quantidade disponivel: {#{$Product->quantidade_estoq}}</p>
                            -->
                        </div>
                    </div>
                    <form action="/car/add_car" method="POST">
                    @csrf
                        <input type="hidden" name="id" value="{{ $Product->id }}">
                        <input type="hidden" name="quantidade_car" id="countProduct" value="1">
                        <div>
                            <h3 class="size__title">Quantidade</h3>
                        </div>

                        <div class="cart__amount" style="margin-bottom: 1.5rem;">
                            <div class="cart__amount-content">
                                <span class="cart__amount-box" onclick="countProductDetais('-')">
                                    <i class="bx bx-minus"></i>
                                </span>

                                <span class="cart__amount-number" id="CountProduct">1</span>
                    
                                <span class="cart__amount-box" onclick="countProductDetais('+')">
                                    <i class="bx bx-plus"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="button">Adicionar ao carrinho</button> 
                    </form>
                </div>
            </div>
        </section>

        <!--=============== RELATED PRODUCTS ===============-->
        <section class="related__products section">
            <div class="new__container container">
                <div class="swiper new-swiper">
                <h2 class="section__title"> Produtos Relacionados</h2>
                    <div class="swiper-wrapper">
                        @if(isset($Products))
                        @foreach ($Products as $product_show)
                        @if($product_show->categoria_produto == $Product->categoria_produto && $product_show->id != $Product->id)
                        <div class="new__content swiper-slide">
                            <div class="new__tag">Novo</div>
                            <a href="/shop/product/{{ $product_show->id }}">
                                <img src="/img/product/{{ $product_show->imagem_produto_1 }}" alt="" class="new__img">
                            </a>
                            <h3 class="new__title">{{ $product_show->nome_produto }}</h3>
                            <span class="new__subtitle">Zapolla</span>

                            <div class="new__prices">
                                <span class="new__price">R$ {{ number_format($product_show->valor_produto, 2, ',', '.') }}</span>
                            </div>

                            <a href="/shop/product/{{ $product_show->id }}" class="button new__button">
                                 <i class="bx bx-cart-alt new__icon"></i>
                            </a>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!--=============== Review ===============-->
        <div class="ratecontainer">
            <div class="post">
              <div class="text">Obrigado pela avaliação!</div>
              <div class="edit">EDITAR</div>
            </div>
            <div class="star-widget">
              <input type="radio" name="rate" id="rate-5">
              <label for="rate-5" class="fas fa-star"></label>
              <input type="radio" name="rate" id="rate-4">
              <label for="rate-4" class="fas fa-star"></label>
              <input type="radio" name="rate" id="rate-3">
              <label for="rate-3" class="fas fa-star"></label>
              <input type="radio" name="rate" id="rate-2">
              <label for="rate-2" class="fas fa-star"></label>
              <input type="radio" name="rate" id="rate-1">
              <label for="rate-1" class="fas fa-star"></label>
              <form action="#">
                <div class="textarea">
                  <textarea cols="30" placeholder="Descreva o que achou do produto.."></textarea>
                </div>
                <div class="ratebtn">
                  <button type="submit">Postar</button>
                </div>
              </form>
            </div>
        </div>
    </main>  

    <!--=============== LIGHTBOX ===============-->
    <div class="lightbox">
        <div class="lightbox__content">
            <div class="lightbox__close">&times;</div>
            <img src="/img/details-1.png" alt="" class="lightbox__img">
            <div class="lightbox__caption">
                <div class="caption__text">You Matter</div>
                <div class="caption__counter"></div>
            </div>
        </div>

        <div class="lightbox__controls">
            <div class="prev__item" onclick="prevItem()"><div class="i bx bx-chevron-left"></div></div>
            <div class="next__item" onclick="nextItem()"><div class="i bx bx-chevron-right"></div></div>
        </div>
    </div>

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up">
        <div class="bx bxs-up-arrow-alt scrollup__icon"></div>
    </a>
    <script>
        
        const productItems = document.querySelectorAll(".product__img"),
              totalProductItems = productItems.length,
              lightbox = document.querySelector(".lightbox"),
              lightboxImg = lightbox.querySelector(".lightbox__img"),
              lightboxClose = lightbox.querySelector(".lightbox__close"),
              lightboxCounter = lightbox.querySelector(".caption__counter");
        let itemIndex = 0;

        for(let i = 0; i < totalProductItems; i++) {
            productItems[i].addEventListener("click", function() {
                itemIndex = i;
                changeItem();
                toggleLightbox();
            })
        }

        function nextItem() {
            if(itemIndex === totalProductItems -1){
                itemIndex = 0;
            }

            else {
                itemIndex++;
            }
            changeItem()
        }

        function prevItem() {
            if(itemIndex === 0){
                itemIndex = totalProductItems -1;
            }

            else {
                itemIndex--;
            }
            changeItem()
        }

        function toggleLightbox() {
            lightbox.classList.toggle("open");
        }

        function changeItem() {
            imgSrc = productItems[itemIndex].querySelector(".product__img img").getAttribute("src");
            lightboxImg.src = imgSrc;
            lightboxCounter.innerHTML = (itemIndex + 1) + " de " + totalProductItems;
        }

        //close lightbox
        lightbox.addEventListener("click",function(){
            if(event.target === lightboxClose || event.target === lightbox) {
                toggleLightbox()
            }
        });
        const maxItens = {{$Product->quantidade_estoq}}

        function countProductDetais(operation){
            const countProduct = document.getElementById('countProduct');
            const quantidadeProdutoElement = document.getElementById('CountProduct');
            var quantidadeProduto = parseInt(quantidadeProdutoElement.textContent);

            console.log(quantidadeProduto);
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
            }
            
        }
        
    </script>
    <!--=============== SWIPER JS ===============-->
    <script src="/js/swiper-bundle.min.js"></script>

    <!--=============== JS ===============-->
    <script src="/js/main.js"></script>
@endsection