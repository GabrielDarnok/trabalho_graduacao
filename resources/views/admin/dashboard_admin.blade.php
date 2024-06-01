@extends('layouts.header')

@section('title','Dashboard Admin')

@section('content')
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                Quantidade de Vulnerabilidades encontradas
              </div>
              <div class="card-body">
                <canvas class="line-chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Quantidade de pedidos por mês
              </div>
              <div class="card-body">
                <canvas class="chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-pie-chart-fill"></i></span>
                Produtos mais vendidos
              </div>
              <div class="card-body">
                <canvas class="pizza-chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                Quantidade de cadastros mensais
              </div>
              <div class="card-body">
                <canvas class="line-chart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Quantidade de produtos cadastrados por mês
              </div>
              <div class="card-body">
                <canvas class="chart2" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Ultimos Pedidos
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table text-center"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>Imagem</th>
                        <th>Nome do produto</th>
                        <th>Email do usuário</th>
                        <th>Quantidade</th>
                        <th>Valor do produto</th>
                        <th>Valor total</th>
                        <th>Data do pedido</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(isset($pedidos))
                    @foreach ($pedidos as $pedido)
                      <tr>
                        <td><img src="/img/product/{{ $pedido->imagem_produto_1 }}" width="50" height="50"></td>
                        <td>{{$pedido->nome_produto}}</td>
                        <td>{{$pedido->email}}</td>
                        <td>{{$pedido->quantidade_car}}</td>
                        <td>R$ {{ number_format($pedido->valor_produto, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                        <td>{{ date('d/m/Y', strtotime($pedido->created_at)) }}</td>
                      </tr>
                    @endforeach
                    @endif
                    <tbody>
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
      <script src="/js/admin/datagraph.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </footer>
@endsection
