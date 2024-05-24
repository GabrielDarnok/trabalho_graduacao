@extends('layouts.header')

@section('title','Scan Admin')

@section('content')
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Usuários</h4>
          </div>
        </div>                
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Usuários cadastrados
              </div>
              <div class="card-body">
                <div class="table-responsive text-center">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    @if(isset($users))
                    @foreach ($users as $user)
                    @if($user->id != Auth::id())
                    <tbody>
                      <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <form id="deleteForm{{ $user->id }}" action="{{ route('user.destroy', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a type="button" class="bi bi-trash-fill" data-toggle="modal" data-target="#confirmarExcluir" data-product-id="{{ $user->id }}" title="Excluir"></a>
                            </form>
                            @if($user->role == "user")
                              <form action="{{ route('change.admin', ['id' => $user->id]) }}" method="POST">
                                  @csrf
                                  <button type="submit">
                                    <i class="bi bi-person-bounding-box">Tornar admin</i>
                                  </button>
                              </form>
                            @elseif ($user->role == "admin")
                              <form action="{{ route('change.user', ['id' => $user->id]) }}" method="POST">
                                  @csrf
                                  <button type="submit">
                                    <i class="bi bi-person-bounding-box">Tornar user</i>
                                  </button>
                              </form>
                            @endif
                        </td>
                      </tr>
                    <tbody>
                    @endif
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
    <footer>
      <script src="/js/admin/jquery-3.5.1.js"></script>
      <script src="/js/admin/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
      <script src="/js/admin/jquery.dataTables.min.js"></script>
      <script src="/js/admin/dataTables.bootstrap5.min.js"></script>
      <script src="/js/admin/script.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
        var deleteRoute = "{{ route('user.destroy', ['id' => ':id']) }}";
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
