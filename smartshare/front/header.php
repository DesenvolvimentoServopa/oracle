<?php
session_start();

if($_GET['id_usuario'] != $_SESSION['id_usuario']){
  header('location: http://10.100.1.217/unico/front/sistemas.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<!--head-->
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Custom fonts for this template-->  
  <script src="https://kit.fontawesome.com/0c2d7c72a0.js" crossorigin="anonymous"></script><!--Version 6.0.0-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/unico.min.css" rel="stylesheet" />
  <link href="../css/unico.min.css" rel="stylesheet" type="text/css" />
  <link href="../css/unico-2.css" rel="stylesheet" type="text/css" />
  <script src="../js/seg.js"></script>

  <!-- Custom styles for table -->

  <link href="../css/style_table.css" rel="stylesheet" id="bootstrap-css">
  <script src="../js/bootstrap_table.min.js"></script>
  <script src="../js/jquerytable.min.js"></script>
  <script src="../js/formCpf.js"></script>
  <script src="../js/tableJq.js "></script>
  <script src="../js/function.js"></script>
  <link rel="stylesheet" href="../css/style_min.css">

  <!-- favicon-->
  <link href="../img/favicon.ico" rel="icon">

  <header id="header" class="fixed-top">

  </header>
</head>


<body id="page-top"  onload="camposObrigatorios()">

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <div>
          <a href="sistemas.php"><img src="../img/logo.png" alt=""></a>
        </div>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-search fa-fw"></i>
            </a>

            <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">Olá, <?= $_SESSION['nome'] ?></span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="http://10.100.1.217/unico/front/editar_usuario.php?id_usuario=<?= $_SESSION['id_usuario'] ?>">
                <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                Perfil
              </a>
              <a class="dropdown-item" href="http://10.100.1.217/unico/front/configuracao.php" style="display: <?= $_SESSION['admin'] == 1 ? "block" : "none" ?>;">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Configuração
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Sair
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- End of Topbar -->

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Sair do sistema ?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times-circle fa-sm fa-fw mr-2 text-gray-400"></i></span>
              </button>
            </div>
            <div class="modal-body text-xs">Selecione "Sair" abaixo se você estiver pronto para encerrar sua sessão atual.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <a class="btn btn-primary" href="../bd/unset.php">Sair</a>
            </div>
          </div>
        </div>
      </div>