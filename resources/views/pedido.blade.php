@extends('layouts.main')

@section('title','cart')

@section('content')

    <!--=============== MAIN ===============-->
    <main class="main">
         <!--=============== SHOP ===============-->
         <section class="shop section container">
            <h2 class="breadcrumb__title">Meus pedidos</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Pedidos</span></h3>

            <div class="checkout__container">
                <div class="checksider__container">
                    <div class="checkout_title">
                        <i class='bx bxs-package'></i>
                        <h3>Produtos</h3>
                    </div>
                    <div class="checkout__box">
                    @foreach ($pedido as $produto)
                        <p>Nome do produto: {{$produto->nome_produto}}</p>
                        <p>Valor unitário: {{$produto->valor_produto}}</p>
                        <p>Valor total: {{$produto->valor_total}}</p>
                        <p>Quantidade no carrinho: {{$produto->quantidade_car}}</p>
                        <img src="/img/product/{{$produto->imagem_produto_1}}" width="100px">
                        <p>Dia da compra: {{ date('d/m/Y', strtotime($produto->created_at)) }}</p>
                        <br><br>
                    @endforeach
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
        function countProductCart(operation, id){
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const totalValueElement = document.getElementById("totalValue");
            const quantidadeProdutosElement = document.getElementById("quantidadeProdutosCart");
            const countProduct = document.getElementById('countProduct'+id);
            const quantidadeProdutoElement = document.getElementById('CountProduct'+id);
            var quantidadeProduto = parseInt(quantidadeProdutoElement.textContent);
            var maxItens = parseInt(document.getElementById('quantidadeCart'+id).value);
            var opcoes = {
                style: 'currency',
                currency: 'BRL'
            }
            if(operation === '-'){
                quantidadeProduto -= 1; 
            }
            if(operation === '+'){
                quantidadeProduto += 1;
                if(quantidadeProduto > maxItens){
                    quantidadeProduto--;
                }
            }
            
            if(quantidadeProduto >= 1){
                quantidadeProdutoElement.textContent = quantidadeProduto;
                countProduct.value = quantidadeProduto;
            }else{
                quantidadeProduto = 1;
            }
            console.log(id+' '+quantidadeProduto);
            $.ajax({
                url: '/edit/car',
                type: 'POST',
                data: {'id': id,
                    'quantidade_car': parseInt(quantidadeProduto),
                    },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response){
                    console.log(response);
                    
                    quantidadeProdutosElement.textContent = response['count'] + " Produtos";
                    totalValueElement.textContent = (response['subtotal']).toLocaleString('pt-BR', opcoes);
                },
                error: function(xhr, status, error) {
                    console.log('erro');
                }
            });
            
        }
    </script>
@endsection