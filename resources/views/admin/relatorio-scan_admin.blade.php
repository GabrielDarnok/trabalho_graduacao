@extends('layouts.header')

@section('title','Relatório Admin')

@section('content')
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Relatórios Scan</h4>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-pie-chart-fill"></i></span>
                Vulnerabilidades Detectadas
              </div>
              <div class="card-body">
                <canvas class="pizza-chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Empresas com mais vulnerabilidades
              </div>
              <div class="card-body">
                <canvas class="chart2" width="400" height="200"></canvas>
              </div>
            </div>
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
                        <th>Empresa</th>
                        <th>Group</th>
                        <th>Vulnerabilidade</th>
                        <th>IP</th>
                        <th>Detectado</th>
                        <th>Ultima notificação</th>
                        <th>Status</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>52863</td>
                        <td>UPX</td>
                        <td>EQNX</td>
                        <td>NTP</td>
                        <td>177.55.128.10</td>
                        <td>25/04/2024</td>
                        <td>02/05/2024</td>
                        <td>Em andamento</td>
                        <td>
                          <div class="d-inline">
                            <a href="/excluir/" class="bi bi-trash-fill mr-4" data-toggle="modal" data-target="#confirmarExcluir" title="Excluir"></a>
                            <a href="/status/" class="bi bi-check2" data-toggle="modal" data-target="#confirmarFinal" title="Finalizar"></a>
                          </div>
                        </td>
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
