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

    <script src="\js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="/painel_de_controle/admin/">GRUPO<strong>TRIBUNA</strong></a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->


      {!! Form::open(['method' => 'POST','url' => 'painel_de_controle/admin/pesquisar', 'class' => 'd-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0']) !!}
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


          @if($aviso_feedback >=1)
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">{!! $aviso_feedback !!}</span>
          </a>

          @endif



          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="\painel_de_controle/admin/feedback">Ver Mensagens</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="\painel_de_controle/admin/config">Configura????es</a>
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
          <a class="nav-link" href="/painel_de_controle/admin/">
            <span data-feather="home">P??gina Inicial</span>
            <span>P??gina Inicial</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Sites</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Links externos</h6>
            <a class="dropdown-item" target="blank" href="http://atdigital.com.br/assinatura">Assinatura</a>
            <a class="dropdown-item" target="blank" href="/ramais">Ramais</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Autentica????o</h6>
            <a class="dropdown-item" target="blank" href="/">Login</a>
            <a class="dropdown-item" target="blank" href="/register">Cadastro</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/config">
            <span data-feather="settings"></span>
            <span>Configura????es</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/empresas">
            <span data-feather="bar-chart-2"></span>
            <span>Empresas</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/departamentos">
            <span data-feather="layers"></span>
            <span>Departamentos</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/usuarios">
            <span data-feather="user-plus"></span>
            <span>Usu??rios</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/eventos">
            <span data-feather="activity"></span>
            <span>Eventos</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/campos_adicionais">
            <span data-feather="folder-plus"></span
            <span>Campos Adicionais</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/mailings">
            <span data-feather="mail"></span
            <span>Mailings</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/clientes">
            <span data-feather="users"></span>
            <span>Clientes</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/feedback">
            <span data-feather="file-text"></span>
            <span>Feedback</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/ramais">
            <span data-feather="phone"></span>
            <span>Ramais</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/painel_de_controle/admin/setores">
            <span data-feather="cpu"></span>
            <span>Setores</span></a>
        </li>
      </ul>
      <!-- Sidebar -->





      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Painel de Controle - ADMINISTRADORES</a>
            </li>
            <li class="breadcrumb-item active">P??gina Inicial</li>
          </ol>


          @include($page)

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Direitos Reservados ?? GRUPO<strong>TRIBUNA</strong> 2019</span>
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
            <h5 class="modal-title" id="exampleModalLabel">Estamos prestes a encerrar a sess??o atual</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">??</span>
            </button>
          </div>
          <div class="modal-body">Por favor, clique em Logout para confirmar ou em cancelar para retornar ?? p??gina anterior. Obrigado!</div>
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
    <script src="\vendor/datatables/jquery.dataTables.js"></script>
    <script src="\vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="\js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="\js/demo/datatables-demo.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

  </body>

</html>
