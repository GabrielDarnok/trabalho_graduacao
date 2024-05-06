@extends('layouts.main')

@section('title','registro')

@section('content')

<!--=============== MAIN ===============-->
<main class="main">

    <!--=============== REGISTER ===============-->
    <section class="register section container">
        <h2 class="breadcrumb__title">Editar Endereço</h2>
        <h3 class="breadcrumb__subtitle">Inicio > Perfil > <span>Editar Endereço</span></h3>
        <div class="card">
            <div class="register__container grid">

                <form action="/endereco/update/{{ $endereco->id }}" method="POST" class="register__form grid">
                    @csrf
                    <div class="register__inputs grid">
                        <div class="register__content">
                            <label for="" class="register__label">CEP</label>
                            <input type="text" class="register__input" name="cep" id="cep " value="{{ $endereco->cep }}" readonly>
                        </div>

                        <div class="register__content">
                            <label for="" class="register__label">Cidade</label>
                            <input type="text" class="register__input" name="cidade" id="cidade" value="{{ $endereco->cidade }}" required>
                        </div>

                        <div class="register__content">
                            <label for="" class="register__label">bairro</label>
                            <input type="text" class="register__input" name="bairro" id="bairro" value="{{ $endereco->bairro }}" required>
                        </div>

                        <div class="register__content">
                            <label for="" class="register__label">Rua</label>
                            <input type="text" class="register__input" name="rua" id="rua" value="{{ $endereco->rua }}" required>
                        </div>

                        <div class="register__content">
                            <label for="" class="contact__label">Numero da casa</label>
                            <input type="text" class="register__input" name="number_house" oninput="validarNumero(this)" id="number_house" value="{{ $endereco->number_house }}" required>
                        </div>

                        <div class="register__content">
                            <label for="" class="register__label">Complemento</label>
                            <input type="text" class="register__input" name="complemento" id="complemento" value="{{ $endereco->complemento }}">
                        </div>
                    </div>
                    <div style = "justify-content: center; display: flex; margin-top: 10px">
                        <button type="submit" class="button">Salvar</button>
                    </div>
                </form>
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
<script>
    function validarNumero(input) {
        input.value = input.value.replace(/\D/g, ''); 
    }
</script>
@endsection