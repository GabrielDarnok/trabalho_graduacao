@extends('layouts.mainshop')

@section('title','shop')

@section('content')

    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== SHOP ===============-->
        <section class="shop section container">
            <h2 class="breadcrumb__title">Shop</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Shop</span></h3>
            <!-- <div style="display: flex; margin-bottom: 40px;">
                <div class="search__box" style = "background-color: #ffffff">
                    <div  style="display: flex; justify-content: space-between; width: 100%">
                        <input class="input" style="border-radius: 10px; border: black" name="search" placeholder="Pesquise aqui" id="valorPesquisa" oninput="productFilter('atual')">
                        <button style="background: white;" onclick="productFilter()">
                            <img src="/img/loupe.png" alt="lupa" height="20" width="20">
                        </button>
                    </div>
                </div>
            </div> -->
            <h3 class="shop__search">Resultados para: </h3>
            @if(isset($message))
				<p style="text-align: center;">{{ $message }}</p>
            @elseif(isset($products))
            <div class="shop__container grid">
                <div class="sidebar" style="height: fit-content">
                    <h3 class="filter__title">Seleção de Filtro</h3>
                    <div class="filter__content">
                        <h3 class="filter__subtitle">Categoria</h3>

                        <div class="filter">
                            <input type="checkbox" value="-" class="inputCategoria" onclick= "productFilter('atual')" name="" id="">
                            <p>Menor Preço</p>
                        </div>

                        <div class="filter" >
                            <input type="checkbox" value="+" class="inputCategoria" onclick= "productFilter('atual')" name="" id="">
                            <p>Maior Preço</p>
                        </div>

                    </div>
                </div>       
                <div class="shop__items grid" id="tableContent">
                </div>
            </div>
            <div class="pagination">
                <i class="bx bx-chevron-left pagination__icon" id="anterior" onclick= "productFilter('anterior')"></i>

                <span class="first-page" id="primeira" onclick= 'productFilter("primeira")' ><<</span>
                <span class="atual current" id="atual" onclick= "productFilter('atual')">1</span>
                <span class="preview" id="atual-proxima" style=" display:none " onclick= "productFilter('proxima')">2</span>
                <span>&middot; &middot; &middot;</span>
                <span class="last-page" id="ultima" onclick= "productFilter('ultima')">1</span>

                <i class="bx bx-chevron-right pagination__icon" id="proxima" onclick= "productFilter('proxima')"></i>
            </div>
            @endif
        </section>
    </main>

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up">
        <div class="bx bxs-up-arrow-alt scrollup__icon"></div>
    </a>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!--=============== SWIPER JS ===============-->
    <script src="/js/swiper-bundle.min.js"></script>

    <!--=============== JS ===============-->
    <script src="/js/main.js"></script>
    
    <script>
        var lastPageElement;
        document.addEventListener("DOMContentLoaded", function() {
            lastPageElement = document.getElementById('ultima');
            productFilter('atual');
        });
        function productFilter(pageLocation) {
            
            const pageElement = document.getElementById('atual');
            const atualProxima = document.getElementById('atual-proxima');
            const lastPageElement = document.getElementById('ultima');

            var page = '';
            if(pageLocation === 'atual'){
                page = parseInt(pageElement.textContent);
            }else if(pageLocation === 'proxima'){
                if(page < 1){
                    page = 1;
                }
                if(page < parseInt(lastPageElement.textContent)){
                    page++;
                }
            }else if(pageLocation === 'anterior'){
                page = parseInt(pageElement.textContent) - 1;
                if(page < 1){
                    page = 1;
                }
            }else if(pageLocation === 'primeira'){
                page = 1;
            }else{
                page = parseInt(lastPageElement.textContent);
            }
            
            console.log(page);

            const pesquisaValor = document.getElementById('valorPesquisa').value;
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var categorias = [];
            var allCategorias = document.querySelectorAll('.inputCategoria');

            allCategorias.forEach(function (checkbox) {
                if (checkbox.checked) {
                    categorias.push(checkbox.value);
                }
            });

            console.log("Categorias selecionadas:", categorias);

            $.ajax({
                url: '/procura/product',
                type: 'POST',
                data: { 'search': pesquisaValor,
                        'categorias': categorias,
                        'page': page, 
                    },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response){
                    console.log(response);
                    adicionarProdutosTabela(response);
                    pageElement.textContent = page;
                    atualProxima.textContent = page + 1;
                    if(response.products){
                        lastPageElement.textContent = response.products.last_page;
                        console.log(response.products.last_page);
                    }
                    
                },
            });
        }
        function adicionarProdutosTabela(objetos){
            var corpoTabela = document.getElementById('tableContent');
            var htmlProduct = '';
            var opcoes = {
                style: 'currency',
                currency: 'BRL'
            };
            if(objetos.products && objetos.products.data){
                objetos.products.data.forEach(function(objeto) {
                    htmlProduct += '<div class="shop__content">';
                    htmlProduct += '<a href="/shop/product/'+objeto.id+'">';
                    htmlProduct += '<img src="/img/product/'+objeto.imagem_produto_1+'" alt="" class="shop__img"></a>';
                    htmlProduct += '<h3 class="shop__title">'+objeto.nome_produto+'</h3>';
                    htmlProduct += '<span class="shop__subtitle">'+objeto.descricao_produto+'</span>';
                    htmlProduct += ' <div class="shop__prices"><span class="shop__price">'+objeto.valor_produto.toLocaleString('pt-BR', opcoes)+'</span></div>';
                    htmlProduct += '<a href="/shop/product/'+ objeto.id+'" class="button shop__button"><i class="bx bx-cart-alt shop__icon"></i></a></div>';
                });
                corpoTabela.innerHTML = htmlProduct;
            }else{
                corpoTabela.innerHTML =  "Nenhum produto encontrado com os critérios de busca :(";
            }
            if(objetos.products){
                lastPageElement.textContent = objetos.products.last_page;
            }
        }
    </script>
    
@endsection