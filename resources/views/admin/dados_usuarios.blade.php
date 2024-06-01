@extends('layouts.header')

@section('title','Relatório Admin')

@section('content')
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dados de contato</h4>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-tag me-2"></i></span> Dados de contato dos clientes
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                      </tr>
                    </thead>
                    @if(isset($dados_users))
                    @foreach ($dados_users as $dado_user)
                    <tbody>
                      <tr>
                        <td>{{ $dado_user->user ? $dado_user->user->name : 'Usuário não encontrado' }}</td>
                        <td>{{ $dado_user->user ? $dado_user->user->email : 'Email não encontrado' }}</td>
                        <td>{{$dado_user->number_phone}}</td>
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
@endsection