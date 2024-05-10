@extends('layouts.main')

@section('title','profile')

@section('content')
        <section class="register section container">
            <h2 class="breadcrumb__title">Perfil</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Perfil</span></h3>
            <div class="card">
                <div class="register__container grid">
                    <div class="profile__box">
                        <img src="/img/profile-pic.png" class="profile-pic">
                        <h3 class="breadcrumb__subtitle">Olá, {{ auth()->user()->name }}</h3>
                        <div class="profile__contact">
                            <a href="#" class="custom-text-colo" onclick="mostrarModal()">Dados pessoais</a>
                            <p id="email" style="display: none;">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <!-- Conteúdo do modal -->
            <div class="modal-content">
                <span class="close" onclick="fecharModal()">&times;</span>
                <h2>Validação de usuário</h2>
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('login') }}" class="login__form grid" id="loginForm">
                    @csrf
                    <div class="login__content">
                        <label for="email" value="{{ __('Email') }}" class="login__label">Email</label>
                        <input id="email" class="login__input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                    </div>
                    <div class="login__content">
                        <label for="password" class="login__label">Senha</label>
                        <input id="password" class="login__input" type="password" name="password" required>
                    </div>
                    <div class="submit-conf">
                        <button type="submit" class="button" onclick="verifyLogin()">Confirmar</button>
                    </div>
                </form>
                
                <!-- Email do usuário -->
                <div id="userEmail" style="display: none;">
                    <h3>Email: {{ auth()->user()->email }}</h3>
                    <a href="#" class="button">Alterar Senha</a>
                </div>
            </div>
        </div>

        <script>
            // Função para confirmar a senha
            function confirmarSenha() {
                var password = document.getElementById("password").value;

                // Aqui você pode adicionar a lógica para verificar a senha

                // Exiba o email do usuário e a opção para alterar a senha
                exibirEmail();
            }

            // Função para exibir o email do usuário e a opção para alterar a senha
            function exibirEmail() {
                var userEmailDiv = document.getElementById("userEmail");
                userEmailDiv.style.display = "block";
            }

            // Função para exibir o modal
            function mostrarModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
            }

            // Função para fechar o modal
            function fecharModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
            }
        </script>
    <!--=============== SWIPER JS ===============-->
    <script src="/js/swiper-bundle.min.js"></script>

    <!--=============== JS ===============-->
    <script src="/js/main.js"></script>

@endsection