@extends('layouts.main')

@section('title','registro')

@section('content')
    
    <!--=============== MAIN ===============-->
    <main class="main">
    
        <!--=============== REGISTER ===============-->
        <section class="register section container">
            <h2 class="breadcrumb__title">Registro de Endereço</h2>
            <h3 class="breadcrumb__subtitle">Inicio > Perfil > <span>Registro</span></h3>
            <div class="card">
            <div class="register__container grid">
                
                <form action="/user/endereco" method="POST" class="register__form grid">
                    @csrf
                    <div class="register__inputs grid">
                        <div class="register__content">
                             <label for="" class="register__label" id="cepLabel">CEP</label>
                             <input type="text" class="register__input" oninput="validarNumero(this)" name="cep" id="cep" required>
                        </div>

                        <div class="register__content">
                            <label for="" class="register__label">Cidade</label>
                            <input type="text" class="register__input" name="cidade" id="cidade" required>
                        </div>

                        <div class="register__content">
                            <label for="" class="register__label">Bairro</label>
                            <input type="text" class="register__input" name="bairro" id="bairro" required>
                        </div>

                        <div class="register__content">
                            <label for="" class="register__label">Rua</label>
                            <input type="text" class="register__input" name="rua" id="rua" required>
                        </div>

                        <div class="register__content">
                            <label for="" type="number" class="contact__label">Numero da casa</label>
                            <input type="text" class="register__input" oninput="validarNumero(this)" name="number_house" id="number_house" required>
                        </div>

                        <div class="register__content">
                            <label for="" class="register__label">Complemento</label>
                            <input type="text" class="register__input" name="complemento" id="complemento">
                        </div>
                    </div>
                   <div style = "justify-content: center; display: flex; margin-top: 10px">
                   <button type="submit" class="button">Cadastrar endereço</button>
                   </div>
                </form>
            </div>
            <div class="product-display">
                   <table class="product-display-table">
                      <thead>
                      <tr>
                         <th>CEP</th>
                         <th>Rua</th>
                         <th>Numero da casa</th>
                         <th>Complemento</th>
                      </tr>
                      </thead>
                      @foreach ($enderecos as $endereco)
                      <tr>
                        <td>{{ $endereco->cep }}</td>
                        <td>{{ $endereco->rua }}</td>
                        <td>{{ $endereco->number_house }}</td>
                        <td>{{ $endereco->complemento }}</td>
                        <td>
                           <a href="/endereco/edit/{{ $endereco->id }}" class="btn"><i class="fas fa-edit"></i> Editar </a> 
                            <form action= "{{route('endereco.destroy', ['endereco' => $endereco]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"> <i class="fas fa-edit"></i> Deletar</button>
                            </form>
                        </td>
                     </tr>
                     @endforeach
                   </table>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
    
    const cepLabel = document.getElementById('cepLabel');
    const CEP = document.getElementById('cep');
    const cidade = document.getElementById('cidade');
    const bairro = document.getElementById('bairro');
    const rua = document.getElementById('rua');

    CEP.addEventListener('focusout', () =>{
        var cepValor = CEP.value;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            url: '/validacep',
            type: 'POST',
            data: {'cep': cepValor,
                },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response){
                if(response !== ''){
                    console.log(response);
                    rua.value = response.logradouro;
                    bairro.value = response.bairro;
                    cidade.value = response.localidade;
                    cepLabel.textContent = "CEP";  
                }else{
                    cepLabel.textContent = "CEP informado está errado!";
                }
                   
            },
             error: function(xhr, status, error) {
                console.log('erro');
            }
        });

    });
    function validarNumero(input) {
        input.value = input.value.replace(/\D/g, ''); 
    }
    </script>
@endsection