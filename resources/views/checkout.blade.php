@extends('layouts.main')

@section('title','contato')

@section('content')
<style>
        form {
            width: 400px;
            background: #d7d7d77a;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 8px;
            display: block;
            font-weight: bold;
        }

        input,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        #element-container {
            margin-bottom: 16px;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    <!--=============== MAIN ===============-->
    <main class="main">
        
    
        <section class="contact section container">
            <h2 class="breadcrumb__title">Pagamento</h2>
            <h1 class="contact__description" style="margin-top: 1.0rem">No momento aceitamos apenas pagamentos por cartão <br> Estamos trabalhando para atender com outros metódos de pagamento, agradecemos
            a compreensão :)</h1>

            <div class="containerpag" style="min-height: unset; padding-bottom: unset">

                <div class="card-container">

                    <div class="front">
                        <div class="image">
                            <img src="img/chip.png" alt="">
                            <img src="img/visa.png" alt="">
                        </div>
                        <div class="card-number-box">################</div>
                        <div class="flexbox">
                            <div class="box">
                                <span>Nome</span>
                                <div class="card-holder-name">Completo</div>
                            </div>
                            <div class="box">
                                <span>Validade</span>
                                <div class="expiration">
                                    <span class="exp-month">mm</span>
                                    <span class="exp-year">yy</span>
                                </div>
                            </div>
                        </div>  
                    </div>

                    <div class="back">
                        <div class="stripe"></div>
                        <div class="box">
                            <span>cvv</span>
                            <div class="cvv-box"></div>
                            <img src="img/visa.png" alt="">
                        </div>
                    </div>

                </div>
                <form action="/checkout/processar" method="post" id="payment-form" style="background: #ffffff24">
                @csrf
                <div id="element-container">
                    <!-- Elementos do Stripe serão inseridos aqui -->
                </div>

                <label for="numero_cartao">Número do Cartão</label>
                <div id="card-number"></div>

                <label for="data_validade">Data de Validade</label>
                <div id="card-expiry"></div>

                <label for="cvc">CVC</label>
                <div id="card-cvc"></div>

                <h3 class="check__subtitle">Total: </h3> <span>R$ {{ number_format($dados['subtotal'], 2, ',', '.') }}</span>

                <button type="submit">Pagar</button>
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
    
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();

        var cardNumber = elements.create('cardNumber');
        cardNumber.mount('#card-number');

        var cardExpiry = elements.create('cardExpiry');
        cardExpiry.mount('#card-expiry');

        var cardCvc = elements.create('cardCvc');
        cardCvc.mount('#card-cvc');

        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            console.log('Botão clicado');
            event.preventDefault();

            stripe.createToken(cardNumber).then(function(result) {
                if (result.error) {
                    // Exiba mensagens de erro ao usuário
                    handleStripeError(result.error);
                } else {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Envie o formulário
                    form.submit();
                }
            });
        });

        function handleStripeError(error) {
        // Aqui você pode lidar com diferentes tipos de erros e exibir mensagens adequadas ao usuário
            if (error.type) {
                alert('Informações do cartão fornecidas estão incorretas. Verifique e tente novamente.');
            }
        }
    </script>
@endsection