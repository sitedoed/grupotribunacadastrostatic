<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
        <link rel="icon" href="\images/favicon.ico">

    <title>Painel de Controle - GRUPOTRIBUNA</title>

    <link href="\css/painel.css" rel="stylesheet">

    <!-- Bootstrap core CSS-->
    <link href="\vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="\vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="\vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="\css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="/painel_de_controle/clientes/">GRUPO<strong>TRIBUNA</strong></a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->


      {!! Form::open(['method' => 'POST','url' => 'painel_de_controle/clientes/pesquisar', 'class' => 'd-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0']) !!}
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Pesquisar..." aria-label="Search" aria-describedby="basic-addon2" name="campo_de_pesquisa">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      {!! Form::close() !!}

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          

          @if(isset($aviso_feedback))
            @if($aviso_feedback >=1)
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger">{{ $aviso_feedback }}</span>
              </a>
            @endif
          @endif


          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="\painel_de_controle/clientes/feedback">Ver Mensagens</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="\painel_de_controle/clientes/config">Configurações</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/painel_de_controle/clientes/">
            <span data-feather="home">Página Inicial</span>
            <span>Página Inicial</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/clientes/config">
            <span data-feather="settings"></span>
            <span>Configurações</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/clientes/eventos">
            <span data-feather="activity"></span>
            <span>Eventos</span></a>
      </ul>
      <!-- Sidebar -->


      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Painel de Controle - Usuários</a>
            </li>
            <li class="breadcrumb-item active">Página Inicial</li>
          </ol>

        @if(   Auth::user()->nivel ==3) 
        @include($page)
        @else
        <script>window.location = "/acesso_restrito";</script>
        @endif

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Direitos Reservados © GRUPO<strong>TRIBUNA</strong> 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Estamos prestes a encerrar a sessão atual</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Por favor, clique em Logout para confirmar ou em cancelar para retornar à página anterior. Obrigado!</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="/logout">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="\vendor/jquery/jquery.min.js"></script>
    <script src="\vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="\vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="\vendor/chart.js/Chart.min.js"></script>
    <script src="\vendor/datatables/jquery.dataTables.js"></script>
    <script src="\vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="\js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="\js/demo/datatables-demo.js"></script>
    <script src="\js/demo/chart-area-demo.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

  </body>

</html>
