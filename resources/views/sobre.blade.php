@extends('layouts.main')

@section('title','Zapolla - Sobre')

@section('content')

    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== ABOUT ===============-->
        <section class="shop section container">
            <h2 class="breadcrumb__title">Quem Somos</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Quem Somos</span></h3>

            <div class="about__container grid">
                <div class="mapBox">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14706.76773576796!2d-47.1879294!3d-22.8508844!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8bda1092335e7%3A0x55a3bb2c931a0963!2sComercial%20Zapolla%20%26%20Silva!5e0!3m2!1spt-BR!2sbr!4v1718663147331!5m2!1spt-BR!2sbr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="about__data">
                    <h2 class="section__title about__title">
                        Nossa História
                    </h2>

                    <p class="about__description">
                        A Comercial Zapolla Silva é uma empresa estabelecida no mercado desde 28 de março de 2017, 
                        com uma trajetória de 7 anos dedicados ao comércio de materiais para construção. Localizada em Sumaré, 
                        São Paulo, a empresa tem se destacado pelo compromisso com a qualidade e a satisfação dos seus clientes.

                        Estamos localizados em uma região estratégica de Sumaré, facilitando o acesso e a distribuição dos nossos produtos.
                        Endereço: Av. Augusta Diogo Ayala, 500 - Jardim Bom Retiro (Nova Veneza), Sumaré - SP, 13181-610
                    </p>

                    <div class="about__details">
                        <p class="about__details-description">
                            <i class="bx bxs-check-square about__details-icon"></i>
                            Qualidade.
                        </p>
    
                        <p class="about__details-description">
                            <i class="bx bxs-check-square about__details-icon"></i>
                            Compromisso.
                        </p>
    
                        <p class="about__details-description">
                            <i class="bx bxs-check-square about__details-icon"></i>
                            Variedade.
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