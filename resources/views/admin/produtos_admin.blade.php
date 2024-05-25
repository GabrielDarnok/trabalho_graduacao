@extends('layouts.header')

@section('title','Scan Admin')

@section('content')
  <!--{% with messages = get_flashed_messages(with_categories=true) %}
  {% if messages %}
    {% for category, message in messages %}
      <div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="meuModalLabel">Aviso</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              message
            </div>
          </div>
        </div>
      </div>
    {% endfor %}
  {% endif %}
{% endwith %}-->
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Produto</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3 d-flex justify-content-center align-items-center">
            <div class="card h-100 d-flex flex-column justify-content-center">
              <div class="card-body">
                <h5 class="card-title mb-4 text-center fw-bold">Adicionar produto</h5>
                <form enctype="multipart/form-data" id="newProductAdd" onsubmit="return processarFormulario()">
                  @csrf
                  <div class="mb-3">
                    <label for="nome_produto" class="form-label">Nome produto</label>
                    <input type="text" placeholder="Insira o nome do produto" id="nome_produto" name="nome_produto" class="form-control" pattern="[A-Za-zÇç]{10,}">
                  </div>
                  <div class="mb-3">
                    <label for="descricao_produto" class="form-label">Descrição</label>
                    <input type="text" placeholder="Insira a descrição" id="descricao_produto" name="descricao_produto" class="form-control" pattern="{10,}">
                  </div>
                  <div class="mb-3">
                    <label for="valor_produto" class="form-label">Valor</label>
                    <input type="text" placeholder="Insira o valor" id="valor_produto" name="valor_produto" class="form-control" pattern="\d+(\.\d{2})?" >
                  </div>
                  <div class="mb-3">
                    <label for="quantidade_estoq" class="form-label">Quantidade</label>
                    <input type="text" placeholder="Insira a quantidade" id="quantidade_estoq" name="quantidade_estoq" class="form-control" pattern="\d+(\.\d{2})?">
                  </div>
                  <div class="mb-3">
                    <label for="arquivo" class="form-label">Imagem do produto (.png, .jpeg, .jpg)</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="imagem_produto_1" id="imagem_produto_1" class="form-control">
                    <div id="arquivoHelp" class="form-text">Faça o upload da imagem do produto</div>
                  </div>
                  <div class="div-select">
                      @if(count($categorys) > 0)
                        <select class="form-control" name="categoria_produto" id="categoria_produto" onchange="toggleCustomInput()">
                          @foreach ($categorys as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                          @endforeach
                          <option value="custom">Outro...</option>
                        </select>
                        <br>
                          <input type="text" class="form-control" name="categoria_produto_2" id="categoria_produto_2" style="display:none;" placeholder="Digite a categoria desejada">
                        <br>
                      @else
                          <input type="text" class="form-control" name="categoria_produto_2" id="categoria_produto_2" placeholder="Digite a categoria desejada">
                          <br>
                      @endif
                  </div>
                  <div class="text-center">
                    <button class="btn btn-primary" onclick="createProduct()" value="add_produto">Enviar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>                   
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Produtos cadastrados
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="product-table" class="table table-striped data-table text-center" style="width: 100%">
                    <thead>
                      <tr>
                        <th>Imagem principal</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Quantidade de imagens</th>
                        <th>Quantidade em estoque</th>
                        <th>Valor do produto</th>
                        <th>Data de inserção</th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    @if(isset($products))
                    @foreach ($products as $product)
                    <tbody>
                      <tr>
                        <td><img src="/img/product/{{ $product->imagem_produto_1 }}" width="50" height="50"></td>
                        <td>{{ $product->nome_produto }}</td>
                        <td>{{ $product->categoria_produto }}</td>
                        <td>{{ count(explode(',', $product->imagem_produto_1)) }}</td>
                        <td>{{ $product->quantidade_estoq }}</td>
                        <td>{{ number_format($product->valor_produto, 2, ',', '.') }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            <form id="deleteForm{{ $product->id }}" action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')                                
                                <a type="button" class="bi bi-trash-fill" data-toggle="modal" data-target="#confirmarExcluir" data-product-id="{{ $product->id }}" title="Excluir"></a>
                            </form>
                        </td>
                      </tr>
                    <tbody>
                    @endforeach
                    @endif
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- JS do DataTables -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

    <!-- JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JS do Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>

    <!-- JS do admin -->
    <script src="/js/admin/script.js"></script>

    <script>

        $(document).ready(function () {
            $('#product-table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                }
            });
        });

        var deleteRoute = "{{ route('product.destroy', ['id' => ':id']) }}";
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
              var categoriaPrincipal = document.getElementById('categoria_produto');

              if (categoriaPrincipal !== null) {
                  var categoria_produto = categoriaPrincipal.value;
              } else {
                  var categoria_produto = "";
              }
    
              var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              var nome_produto = document.getElementById('nome_produto').value;
              var descricao_produto = document.getElementById('descricao_produto').value;
              var valor_produto = document.getElementById('valor_produto').value;
              var quantidade_estoq = document.getElementById('quantidade_estoq').value;         
              var categoria_produto_2 = document.getElementById('categoria_produto_2').value;
              var imagem_produtoSt = document.getElementById('imagem_produto_1');

              if(verificaNome(nome_produto)){
                permissao++;
                msgErro = "<li>O nome do produto possui caracteres especiais!</li>";             
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

              if(permissao == 0){
                var formData = new FormData();
                formData.append('nome_produto', nome_produto);
                formData.append('descricao_produto', descricao_produto);
                formData.append('valor_produto', valor_produto);
                formData.append('quantidade_estoq', quantidade_estoq);
                formData.append('categoria_produto', categoria_produto);
                formData.append('categoria_produto_2', categoria_produto_2);
                formData.append('imagem_produto_1', imagem_produtoSt.files[0]);

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
                  htmlLinhas += '<td>' + "<img src='img/product/"+objeto.imagem_produto_1+"' height='100' alt=>" + '</td>';
                  htmlLinhas += '<td>' + objeto.nome_produto + '</td>';
                  htmlLinhas += '<td>' + objeto.descricao_produto + '</td>';
                  htmlLinhas += '<td>' + objeto.valor_produto + '</td>';
                  htmlLinhas += '<td>' + objeto.quantidade_estoq + '</td>';
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
    <script>
      function toggleCustomInput() {
        var select = document.getElementById("categoria_produto");
        var customInput = document.getElementById("categoria_produto_2");
        if (select.value === "custom") {
          customInput.style.display = "block";
          customInput.name = "categoria_produto";  // Change the name to match the select
          select.name = "";  // Clear the select name so it doesn't get submitted
        } else {
          customInput.style.display = "none";
          customInput.name = "categoria_produto_2";  // Reset the name to avoid conflicts
          select.name = "categoria_produto";  // Restore the select name
        }
      }
    </script>
@endsection
