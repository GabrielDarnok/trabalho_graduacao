@extends('layouts.main')

@section('title','edit-admin')

@section('content')

    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== ADM ===============-->
        <section class="adm__container container">
            <h2 class="breadcrumb__title">Administrador</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Administrador</span></h3>
            
            <div class="containeradm">

                <div class="admin-product-form-container">
             
                   <form action="/admin/update/{{ $Product->id }}" method="post" enctype="multipart/form-data">
                   @csrf
                        <div class="add">
                            <h3>Adicionar um novo Produto</h3>
                        </div>
                      <input type="text" value="{{ $Product->nome_produto }}" id="nome_produto" name="nome_produto" class="box">
                      <input type="text" placeholder="Insira a descrição" value="{{ $Product->descricao_produto }}" id="descricao_produto" name="descricao_produto" class="box">
                      <input type="text" placeholder="Insira o valor" value="{{ $Product->valor_produto }}" id="valor_produto" name="valor_produto" class="box">
                      <input type="text" placeholder="Insira a quantidade" value="{{ $Product->quantidade_estoq }}" id="quantidade_estoq" name="quantidade_estoq" class="box">

                      <div class="dropdown">
                        <div class="">
                            <input type="checkbox" name="tamanho_roupa[]" value="G"> G
                        </div>
                        <div class="">
                            <input type="checkbox" name="tamanho_roupa[]" value="GG"> GG
                        </div>
                        <div class="">
                            <input type="checkbox" name="tamanho_roupa[]" value="G3"> G3
                        </div>
                        <div class="">
                            <input type="checkbox" name="tamanho_roupa[]" value="G4"> G4
                        </div>
                        <div class="">
                            <input type="checkbox" name="tamanho_roupa[]" value="G5"> G5
                        </div>
                      </div>
                      
                      <div class="dropdown">
                         <div class="">
                              <input type="checkbox" name="cor_produto[]" value="Preto"> Preto
                          </div>
                          <div class="">
                              <input type="checkbox" name="cor_produto[]" value="Vermelho"> Vermelho
                          </div>
                          <div class="">
                              <input type="checkbox" name="cor_produto[]" value="Verde"> Verde
                          </div>
                          <div class="">
                              <input type="checkbox" name="cor_produto[]" value="Amarelo"> Amarelo
                          </div>                                    
                      </div>

                      <div class="dropdown">
                        <button class="dropbtn">Categoria</button>
                        <div class="dropdown-content">
                          <select type="text" class="form-control" name="categoria_produto" id="categoria_produto">
                            <option value="Casual" {{ $Product->categoria_produto == "Casual" ? "selected = 'selected'": "" }}>Casual</option>
                            <option value="Streetwear" {{ $Product->categoria_produto == "Streetwear" ? "selected = 'selected'": "" }}>Streetwear</option>
                            <option value="Fofo" {{ $Product->categoria_produto == "Fofo" ? "selected = 'selected'": "" }}>Fofo</option>
                            <option value="Festa" {{ $Product->categoria_produto == "Festa" ? "selected = 'selected'": "" }}>Festa</option>
                            <option value="Elegante" {{ $Product->categoria_produto == "Elegante" ? "selected = 'selected'": "" }}>Elegante</option>
                            </select>
                        </div>
                      </div>
                      
                      <div>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagem_produto" id="imagem_produto" class="box">
                        <img src="/img/product/{{$Product->imagem_produto}}" alt="{{ $Product->nome_produto }}" style="max-width: 10rem; max-height: 10rem;" class="img-preview">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagem_produto_2" id="imagem_produto_2" class="box">
                        <img src="/img/product/{{$Product->imagem_produto_2}}" alt="{{ $Product->nome_produto }}" style="max-width: 10rem; max-height: 10rem;" class="img-preview">                              
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagem_produto_3" id="imagem_produto_3" class="box">
                        <img src="/img/product/{{$Product->imagem_produto_3}}" alt="{{ $Product->nome_produto }}" style="max-width: 10rem; max-height: 10rem;" class="img-preview">                      
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagem_produto_4" id="imagem_produto_4" class="box">
                        <img src="/img/product/{{$Product->imagem_produto_4}}" alt="{{ $Product->nome_produto }}" style="max-width: 10rem; max-height: 10rem;" class="img-preview">   
                        <input type="submit" class="btn" value="editar produto">
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
@endsection