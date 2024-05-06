@extends('layouts.main')

@section('title','admin')

@section('content')
    <style>
        select{
            -webkit-appearance:none;
            -moz-appearance:none;
            -ms-appearance:none;
            appearance:none;
            outline:0;
            box-shadow:none;
            border:0!important;
            background: #f27474;
            background-image: none;
            flex: 1;
            padding: 0 .5em;
            color:#fff;
            cursor:pointer;
            font-size: 1em;
            font-family: 'Open Sans', sans-serif;
            border-radius: .25em;
            height: 100%;
            width: 100%;
        }
        select::-ms-expand {
            display: none;
        }
        .div-select{
            margin-top: 1.5rem;
            height: 2rem;
            width: 10rem;
        }
    </style>
    <!--=============== MAIN ===============-->
    <main class="main">
        <!--=============== ADM ===============-->
        <section class="adm__container container">
            <h2 class="breadcrumb__title">Administrador</h2>
            <h3 class="breadcrumb__subtitle">Inicio > <span>Administrador</span></h3>
            
            <div class="containeradm">

                <div class="admin-product-form-container">
             
                   <form enctype="multipart/form-data" id="newProductAdd" onsubmit="return processarFormulario()">
                   @csrf
                        <div class="add">
                            <h3>Adicionar um novo Produto</h3>
                        </div>
                      <input type="text" placeholder="Insira o nome do produto" id="nome_produto" name="nome_produto" class="box" pattern="[A-Za-zÇç]{10,}">
                      <input type="text" placeholder="Insira a descrição" id="descricao_produto" name="descricao_produto" class="box" pattern="{10,}">
                      <input type="text" placeholder="Insira o valor" id="valor_produto" name="valor_produto" class="box" pattern="\d+(\.\d{2})?" >
                      <input type="text" placeholder="Insira a quantidade" id="quantidade_estoq" name="quantidade_estoq" class="box" pattern="\d+(\.\d{2})?">

                      <div class="dropdown">
                        <div class="">
                            <input type="checkbox" class="checkboxTam" onclick="adicionarValorTam()" value="G"> G
                        </div>
                        <div class="">
                            <input type="checkbox" class="checkboxTam" onclick="adicionarValorTam()" value="GG"> GG
                        </div>
                        <div class="">
                            <input type="checkbox" class="checkboxTam" onclick="adicionarValorTam()" value="G3"> G3
                        </div>
                        <div class="">
                            <input type="checkbox" class="checkboxTam" onclick="adicionarValorTam()" value="G4"> G4
                        </div>
                        <div class="">
                            <input type="checkbox" class="checkboxTam" onclick="adicionarValorTam()" value="G5"> G5
                        </div>
                      </div>
                      
                      <div class="dropdown">
                         <div class="">
                              <input type="checkbox" class="checkboxCor" onclick="adicionarValorCor()" value="Preto"> Preto
                          </div>
                          <div class="">
                              <input type="checkbox" class="checkboxCor" onclick="adicionarValorCor()" value="Vermelho"> Vermelho
                          </div>
                          <div class="">
                              <input type="checkbox" class="checkboxCor" onclick="adicionarValorCor()" value="Verde"> Verde
                          </div>
                          <div class="">
                              <input type="checkbox" class="checkboxCor" onclick="adicionarValorCor()" value="Amarelo"> Amarelo
                          </div>                                    
                      </div>
                                   
                        <div class="div-select">
                          <select type="text" class="form-control" name="categoria_produto" id="categoria_produto">
                            <option value="Casual">Casual</option>
                            <option value="Streetwear">Streetwear</option>
                            <option value="Fofo">Fofo</option>
                            <option value="Festa">Festa</option>
                            <option value="Elegante">Elegante</option>
                          </select>
                        </div>
                      
                      <div>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagem_produto" id="imagem_produto" class="box">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagem_produto_2" id="imagem_produto_2" class="box">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagem_produto_3" id="imagem_produto_3" class="box">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagem_produto_4" id="imagem_produto_4" class="box">
                        <button class="btn" onclick="createProduct()" value="add_produto">Adicionar Produto</button>
                      </div>
                   </form>
             
                </div>
             
                <div class="product-display" style="overflow: auto;">
                   <table class="product-display-table">
                      <thead>
                      <tr>
                         <th>Imagem</th>
                         <th>Nome</th>
                         <th>Descrição</th>
                         <th>Valor</th>
                         <th>Estoque</th>
                         <th>Tamanho</th>
                         <th>Cor</th>
                         <th>Ação</th>
                      </tr>
                      </thead>
                      <tbody id= "tableContent">
                      @if (isset($products))
                      @foreach ($products as $product)
                      <tr>
                          <td><img src="img/product/{{ $product->imagem_produto }}" height="100" alt=""></td>
                          <td>{{ $product->nome_produto }}</td>
                          <td>{{ $product->descricao_produto }}</td>
                          <td>{{ number_format($product->valor_produto, 2, ',', '.') }}</td>
                          <td>{{ $product->quantidade_estoq }}</td>
                          <td>{{ $product->tamanho_roupa }}</td>
                          <td>{{ $product->cor_produto}}</td>
                          <td>
                            <a href="/admin/edit/{{ $product->id }}" class="btn"><i class="fas fa-edit"></i> Editar </a> 
                              <form action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn"> <i class="fas fa-edit"></i> Deletar</button>
                              </form>
                          </td>
                       </tr>
                     @endforeach
                     @endif
                      </tbody>
                   </table>
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
        var deleteRoute = "{{ route('product.destroy', ['id' => ':id']) }}";
        if(!Tamanhos && !Cores){
            var Tamanhos = [];
            var Cores = [];
        }
          
        function adicionarValorTam() {
            Tamanhos = [];
            var checkboxTam = document.querySelectorAll('.checkboxTam:checked');
            
            checkboxTam.forEach(function(checkbox){
                Tamanhos.push(checkbox.value);
            });
            console.log(Tamanhos);
        }
        function adicionarValorCor(){
          Cores = [];
          var checkboxCor = document.querySelectorAll('.checkboxCor:checked');
            
            checkboxCor.forEach(function(checkbox){
                Cores.push(checkbox.value);
            });
            console.log(Cores);
        }
        function processarFormulario() {
          return false;
        }
        function verificaNome(str){
          var regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?0-9]/;

          return regex.test(str)
        }
        function verificaValor(number){

          return /^[0-9.]+$/.test(number);
        }
        function varificaQuantidade(number) {
            
          return /^\d+$/.test(number);
        }
        function createProduct(){
          
              event.preventDefault();
              var permissao = 0;
              var msgErro = '';
              var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              const nome_produto = document.getElementById('nome_produto').value;
              const descricao_produto = document.getElementById('descricao_produto').value;
              const valor_produto = document.getElementById('valor_produto').value;
              const quantidade_estoq = document.getElementById('quantidade_estoq').value;
              const categoria_produto = document.getElementById('categoria_produto').value;
              const imagem_produtoSt = document.getElementById('imagem_produto');
              const imagem_produto_2 = document.getElementById('imagem_produto_2');
              const imagem_produto_3 = document.getElementById('imagem_produto_3');
              const imagem_produto_4 = document.getElementById('imagem_produto_4');

              if(verificaNome(nome_produto)){
                permissao++;
                msgErro = "<li>O nome do produto possui caracteres especiais!</li>";             
              }
              if(Tamanhos.length === 0 || Cores.length === 0){
                permissao++;
                msgErro += "<li>Necessário possuir tamanho e cor!</li>";
              }
              if(!verificaValor(valor_produto) || (valor_produto < 0)){
                permissao++;
                msgErro += "<li>O valor do produto informado é inválido!</li>";
              }
              if(!varificaQuantidade(quantidade_estoq) || (quantidade_estoq < 0)){
                permissao++;
                msgErro += "<li>O valor da quantidade em estoque informado é inválido!</li>";
              }
              if(imagem_produtoSt.files[0] == null){
                permissao++;
                msgErro += "<li>Imagem 1 não foi selecionada</li>";
              }
              if(imagem_produto_2.files[0] == null){
                permissao++;
                msgErro += "<li>Imagem 2 não foi selecionada</li>";
              }
              if(imagem_produto_3.files[0] == null){
                permissao++;
                msgErro += "<li>Imagem 3 não foi selecionada</li>";
              }
              if(imagem_produto_4.files[0] == null){
                permissao++;
                msgErro += "<li>Imagem 4 não foi selecionada</li>";
              }

              if(permissao == 0){
                console.log(imagem_produto);

                var formData = new FormData();
                formData.append('nome_produto', nome_produto);
                formData.append('descricao_produto', descricao_produto);
                formData.append('valor_produto', valor_produto);
                formData.append('quantidade_estoq', quantidade_estoq);
                formData.append('tamanho_roupa', Tamanhos);
                formData.append('cor_produto', Cores);
                formData.append('categoria_produto', categoria_produto);
                formData.append('imagem_produto', imagem_produtoSt.files[0]);
                formData.append('imagem_produto_2', imagem_produto_2.files[0]);
                formData.append('imagem_produto_3', imagem_produto_3.files[0]);
                formData.append('imagem_produto_4', imagem_produto_4.files[0]);

                console.log(formData);
                $.ajax({
                    url: '/products',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    contentType: false,
                    processData: false,
                    success: function(response){
                        Swal.fire(
                          'Sucesso!',
                          'Produto adicionado com sucesso',
                          'success',
                        );
                        Cores = [];
                        Tamanhos = [];  
                        adicionarObjetosATabela(response);
                        document.getElementById('newProductAdd').reset();
                    },
                    error: function(xhr, status, error) {
                      Swal.fire(
                          'Erro!',
                          'Ocorreu um erro ao adicionar o produto: ' + error,
                          'error'
                      );
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
        function adicionarObjetosATabela(objetos) {
            var corpoDaTabela = document.getElementById("tableContent");
            var htmlLinhas = '';
              objetos.products.forEach(function(objeto) {
                  htmlLinhas += '<tr>';
                  htmlLinhas += '<td>' + "<img src='img/product/"+objeto.imagem_produto+"' height='100' alt=>" + '</td>';
                  htmlLinhas += '<td>' + objeto.nome_produto + '</td>';
                  htmlLinhas += '<td>' + objeto.descricao_produto + '</td>';
                  htmlLinhas += '<td>' + objeto.valor_produto + '</td>';
                  htmlLinhas += '<td>' + objeto.quantidade_estoq + '</td>';
                  htmlLinhas += '<td>' + objeto.tamanho_roupa + '</td>';
                  htmlLinhas += '<td>' + objeto.cor_produto + '</td>';
                  htmlLinhas += '<td>' + '<a href="/admin/edit/'+objeto.id+'" class="btn"><i class="fas fa-edit"></i> editar </a>' +
                                          '<form action="'+ deleteRoute.replace(':id', objeto.id) +'" method="POST">' +
                                          '    @csrf' +
                                          '    @method("DELETE")' +
                                          '    <button type="submit" class="btn"> <i class="fas fa-edit"></i> DELETAR</button>' +
                                          '</form>' + '</td>';
                  htmlLinhas += '</tr>';
            });

            corpoDaTabela.innerHTML = htmlLinhas;
        }            
      </script>
@endsection