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
                        <td class="action-td">
                            <form id="deleteForm{{ $user->id }}" action="{{ route('user.destroy', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmarExcluir" data-product-id="{{ $user->id }}" title="Excluir">
                                    <i class="bi bi-trash-fill"></i>
                                    Excluir
                                </a>
                            </form>
                            @if($user->role == "user")
                              <form action="{{ route('change.admin', ['id' => $user->id]) }}" method="POST">
                                  @csrf
                                  <button class="btn btn-secondary" type="submit">
                                    <i class="bi bi-person-check-fill">Tornar admin</i>
                                  </button>
                              </form>
                            @elseif ($user->role == "admin")
                              <form action="{{ route('change.user', ['id' => $user->id]) }}" method="POST">
                                  @csrf
                                  <button class="btn btn-secondary" type="submit">
                                    <i class="bi bi-person-fill">Tornar user</i>
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
      <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- JS do DataTables -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

    <!-- JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JS do admin -->
    <script src="/js/admin/script.js"></script>

    </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
        var deleteRoute = "{{ route('user.destroy', ['id' => ':id']) }}";
        function processarFormulario() {
          return false;
        }           
    </script>
@endsection
