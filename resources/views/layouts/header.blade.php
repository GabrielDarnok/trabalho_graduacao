<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/admin/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="/css/admin/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/css/admin/style.css">
    <title>@yield('title')</title>
  </head>
  <header>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="/dashboard_admin">
          <img src="/img/logo_zap.png" class="img-fluid" style="max-width: 80px;">
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-right: 10px;">
                      <i class="bi bi-person-fill"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <form action="/logout" method="POST" class="sub-menu-link">
                        @csrf
                        <li><a href="/logout" class="bx bx-log-out" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a></li>
                      </form>
                  </ul>
              </li>
          </ul>
      </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0 bg-home">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li class="my-4"><hr class="dropdown-divider" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                Ferramentas
              </div>
            </li>
            <li>
              <a href="/" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-house"></i></span>
                <span>Home</span>
              </a>
            </li>
            <li>
              <a href="/dashboard_admin" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-columns-gap"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="/produtos_admin" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-box-seam"></i></span>
                <span>Produtos</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Interface
              </div>
            </li>
            <li>
              <a
                class="link-nav px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Layouts</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="/relatorio_admin" class="nav-link px-3 sub-item">
                      <span class="me-2"
                        ><i class="bi bi-clipboard"></i
                      ></span>
                      <span>Relatório dos clientes</span>
                    </a>
                  </li>
                  <li>
                    <a href="/relatorio-scan_admin" class="nav-link px-3 sub-item">
                      <span class="me-2"
                        ><i class="bi bi-clipboard-data"></i
                      ></span>
                      <span>Detalhes do scan</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Complementos
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-person"></i></span>
                <span>Administrar usuários</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
  <body>
    <div class="modal fade" id="confirmarExcluir" tabindex="-1" role="dialog" aria-labelledby="confirmarExcluirLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="confirmarExcluirLabel">Confirmar Exclusão</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Tem certeza que deseja excluir?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="confirmarExclusaoBtn">Excluir</button>
            </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="confirmarFinal" tabindex="-1" role="dialog" aria-labelledby="confirmarFinalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="confirmarFinalLabel">Confirmar Encerramento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Tem certeza que deseja finalizar o ticket?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <a href="/status/" class="btn btn-danger">Finalizar</a>
            </div>
        </div>
      </div>
    </div>
    @yield ('content')
  </body>
</html>