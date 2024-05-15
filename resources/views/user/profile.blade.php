@extends('layouts.main')

@section('title','profile')

@section('content')
        <section class="shop register section container">
            <h2 class="breadcrumb__title">Perfil</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Perfil</span></h3>
            <div class="card">
                <div class="register__container grid">
                    <div class="profile__box">
                        <img src="/img/profile-pic.png" class="profile-pic">
                        <h3 class="breadcrumb__subtitle">Olá, {{ auth()->user()->name }}</h3>
                        <div class="profile__contact">
                            <a href="/confirm-password" class="custom-text-colo">Alterar a senha</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--=============== SWIPER JS ===============-->
    <script src="/js/swiper-bundle.min.js"></script>

    <!--=============== JS ===============-->
    <script src="/js/main.js"></script>

@endsection