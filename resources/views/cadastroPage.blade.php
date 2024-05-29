@extends('layouts.maincadastro')

@section('title','cadastroPage')

@section('content')
    <style>
        .inputcadastro{
            max-width: 50%;
        }
        .form_section{
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0.8rem;
            margin-bottom: 2.0rem;
            align-items: center;
        }
        .form_input{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
        .contact__label{
            display: flex;
            flex-direction: column;
            width: 70%;
        }

        .login__content {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            width: 27rem;
            padding: .30rem 1rem .30rem;
        }

        .login__label i {
            font-size: 1.25rem;
        }

        .contact__input{
            height: 3rem;
            padding: unset;
        }

        #formCadastro {
            margin-top: 3rem;
        }

        .contact__input::placeholder {
            color: var(--title-color);
        }

        @media screen and (max-width: 768px){
            .form_input {
                display: block;  
            }
            
            .form_section{
                gap: 1.5rem;
            }

            .login__content {
                width: 100%;
            }

            .cad {
                width: 13rem;
            }
        }
        
    </style>
    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== ABOUT ===============-->
        <section class="shop section container">
            <h2 class="breadcrumb__title">Cadastro</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Cadastro</span></h3>

            <div class="container">
                <form method="POST" action="{{ route('register') }}" id="formCadastro">
                    <p style="text-align: center;padding-bottom: 3rem;">Junte-se a nós e aproveite ofertas exclusivas! <br>Crie sua conta agora para uma experiência de compra personalizada.</p>
                    <div class = "form_input"> 
                        @csrf  
                        <div class = "form_section">
                            <div class = "login__content">
                                <label for="nome" class = "login__label"><i class='bx bx-user'></i></label>
                                <input  class="contact__input" style ="width: 100%" placeholder="Nome" type="text" id="name" name="name" required>
                            </div>
                            <div class = "login__content">
                                <label for="email" class = "login__label" ><i class='bx bx-envelope' ></i></label>
                                <input class="contact__input" style ="width: 100%" placeholder="Email" type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div class = "form_section">
                            <div class = "login__content">
                                <label for="senha" class = "login__label"><i class='bx bxs-lock-alt' ></i></label>
                                <input  class="contact__input" style ="width: 100%" placeholder="Senha" type="password" id="password" name="password" required>
                                <i class="fa-solid fa-eye" id="show-password" onclick="passwordToggle(true)"></i>
                                <i class="fa-solid fa-eye-slash" id="hide-password" style="display: none" onclick="passwordToggle(false)"></i>
                            </div>
                            <div class = "login__content">
                                <label for="confirmar_senha" class = "login__label"><i class='bx bxs-lock-alt' ></i></label>
                                <input  class="contact__input" style ="width: 100%" placeholder="Confirmar senha" type="password" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div style= "display: flex; justify-content: center; width: 100%; margin-top: 1.25rem;">
                        <a class= "button cad" type="button" onclick="validaCampos()" style="width: 20rem; display: flex; justify-content: center;">Cadastrar</a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script>
        
        function passwordToggle(arg) {
            if (arg === true) {
                $('#show-password').hide();
                $('#hide-password').show();
                $('#password').attr('type', 'text');
            } else {
                $('#hide-password').hide();
                $('#show-password').show();
                $('#password').attr('type', 'password');
            }
        }

        function validaCampos(){
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const nome = document.getElementById('name');
            const email = document.getElementById('email');
            const senha = document.getElementById('password');
            const confirmarSenha = document.getElementById('password_confirmation');
            var erros = 0;
            var msgErro = '';

            if(!validaNome(nome.value)){
                erros++;
                msgErro += "<li>O nome não deve possuir caracteres especiais ou números!</li>";
                nome.focus();  
            }
            if(!validarEmail(email.value)){
                erros++;
                msgErro += "<li>Email inválido!</li>"; 
                email.focus();
            }
            if(senha.value.length < 8){
                erros++;
                msgErro += "<li>A senha deve possuir no mínimo 8 caracteres!</li>";
                senha.focus();
            }else{
                if(senha.value !== confirmarSenha.value){
                    erros++;
                    msgErro += "<li>Senha e confirmar senha estão diferentes!</li>";
                    confirmarSenha.focus(); 
                }
            }
            
            console.log(erros);

            if(erros === 0 ){
                //document.getElementById('formCadastro').submit();
                $.ajax({
                    url: '{{ route('register') }}',
                    type: 'POST',
                    data: {
                        'name': nome.value,
                        'email': email.value,
                        'password': senha.value,
                        'password_confirmation': confirmarSenha.value,
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) { 
                        Swal.fire({
                            title: "Boa!",
                            text: "Cadastro feito com sucesso! Aproveite as compras!",
                            icon: "success"
                        }).then((result) => {
                            window.location.href = '/';
                        });                                 
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                        Swal.fire({
                            title: "Opa!",
                            text: "Email já está em uso!",
                            icon: "error"
                        })
                    }
                });
            }else{
                Swal.fire(
                  'Opa!',
                  msgErro,
                  'error'
                );
            }
        }
        function validaNome(nome){

            var regex = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s']+$/;

            return regex.test(nome);        
        }
        function validarEmail(email) {
           
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
            return regex.test(email);
        }

    </script>

@endsection