@extends('layouts.main')

@section('title','sobre')

@section('content')

    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== ABOUT ===============-->
        <section class="about section container">
            <h2 class="breadcrumb__title">Quem Somos</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Quem Somos</span></h3>

            <div class="about__container grid">
                <img src="/img/about-img.png" alt="" class="about__img">

                <div class="about__data">
                    <h2 class="section__title about__title">
                        Nossa História
                    </h2>

                    <p class="about__description">
                        A missão da You Matter é trazer o streetwear moderno feminino para o público
                        plus size brasileiro, sempre trazendo tendências e quebrando o tabu, de que,
                        mulhere acima do peso tem que usar um determinado tipo de roupa. O nome da empresa
                        foi pensado em vocês... You Matter significa "você importa", para nós vocês são importantes
                        . Queremos trazer sempre o melhor em questão de novidades, qualidade, caimente, tecido e
                        corte. Pois vocês importam.
                    </p>

                    <div class="about__details">
                        <p class="about__details-description">
                            <i class="bx bxs-check-square about__details-icon"></i>
                            Entregas dentro do prazo.
                        </p>
    
                        <p class="about__details-description">
                            <i class="bx bxs-check-square about__details-icon"></i>
                            Suporte para suas duvidas ou cuidado dos seus produtos.
                        </p>
    
                        <p class="about__details-description">
                            <i class="bx bxs-check-square about__details-icon"></i>
                            100% retorno do dinheiro caso o produto venha com defeito ou caso você não goste (Dentro de 3 dias).
                        </p>
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

@endsection