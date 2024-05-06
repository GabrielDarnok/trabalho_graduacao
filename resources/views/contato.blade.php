@extends('layouts.main')

@section('title','contato')

@section('content')

    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== CONTACT US ===============-->
        <section class="contact section container">
            <h2 class="breadcrumb__title">Contato</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Contato</span></h3>
            <h1 class="contact__description">Gostaria de entrar em contato ? só mandar uma mensagem ou se estiver <br> interessado em trabalhar
            conosco. Mande um email com seu curriculo/portifólio para darmos uma olhada :)</h1>

            <div class="contact__container grid">
                <div>
                    <div class="contact__information">
                        <div class="bx bx-phone contact__icon"></div>
                        <div>
                            <h3 class="contact__title">Telefone</h3>
                            <span class="contact__subtitle">(19) 99666-9999</span>
                        </div>
                    </div>

                    <div class="contact__information">
                        <div class="bx bx-envelope contact__icon"></div>
                        <div>
                            <h3 class="contact__title">Email</h3>
                            <span class="contact__subtitle">youmatter@email.com</span>
                        </div>
                    </div>

                    <div class="contact__information">
                        <div class="bx bx-map contact__icon"></div>
                        <div>
                            <h3 class="contact__title">Localidade</h3>
                            <span class="contact__subtitle">Av. Cônego Antônio Roccato, 593 - Jardim Santa Monica, Campinas - SP</span>
                        </div>
                    </div>
                </div>

                <form action="" class="contact__form grid">
                    <div class="contact__inputs grid">
                        <div class="contact__content">
                             <label for="" class="contact__label">Nome</label>
                             <input type="text" class="contact__input">
                        </div>

                        <div class="contact__content">
                            <label for="" class="contact__label">Email</label>
                            <input type="email" class="contact__input">
                       </div>
                    </div>

                    <div class="contact__content">
                        <label for="" class="contact__label">Assunto</label>
                        <input type="text" class="contact__input">
                   </div>

                   <div class="contact__content">
                        <label for="" class="contact__label">Mensagem</label>
                        <textarea name="" id="" cols="0" rows="7" class="contact__input"></textarea>
                   </div>

                   <div>
                        <a href="#" class="button">Enviar</a>
                   </div>
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