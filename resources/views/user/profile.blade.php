@extends('layouts.main')

@section('title','profile')

@section('content')
    
    <!--=============== MAIN ===============-->
    <main class="main">
    
    <!--=============== REGISTER ===============-->
        <section class="register section container">
            <h2 class="breadcrumb__title">Perfil</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Perfil</span></h3>
            <div class="card">
            <div class="register__container grid">

                <div class="profile__box">
                    <img src="/img/profile-pic.png" class="profile-pic">
                    <h3 class="breadcrumb__subtitle">Olá, {{ auth()->user()->name }}.
                </div>  

                <form action="" class="register__form grid">
                        <div class="profile__contact">
                            <h2 class="info__text">Informações de Contato</h2>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            
            <div class="card" style="margin-top: 2.0rem; padding: 20px;">
                <a href="/registro_end" id="toggleFields" class="collapse-btn" style= "width: 50%">Cadastrar endereco</a>
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