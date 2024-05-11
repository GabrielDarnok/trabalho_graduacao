@extends('layouts.header')

@section('title','Relatório Admin')

@section('content')
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Relatórios</h4>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-tag me-2"></i></span> Tickets de Clientes
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
                        <th>ASN</th>
                        <th>Nome da empresa</th>
                        <th>Vulnerabilidades detectadas</th>
                        <th>Vulnerabilidades corrigidas</th>
                        <th>Ultimo Scan</th>
                        <th>Status</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>52863</td>
                        <td>UPX</td>
                        <td>45</td>
                        <td>1980</td>
                        <td>25/04/2024</td>
                        <td>Em andamento</td>
                        <td><a href="/excluir/relat/" class="bi bi-trash-fill" data-toggle="modal" data-target="#confirmarExcluir" title="Excluir" title="Download"></a></td>
                      </tr>
                    <tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-end"> <!-- Alinhando à direita -->
          <div class="col-auto">
              <a href="/download" class="btn btn-primary link-download" download>Download da Planilha</a>
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