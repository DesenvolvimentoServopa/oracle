<?php
include 'header.php';
?>

<!-- Begin Page Content -->
<div class="container">

  <!-- Page Heading -->
  <h1 class="text-xs mb-6 text-gray-800">
    <a href="sistemas.php"><i class="fas fa-home"></i> Home</a> /
    <a href="configuracao.php"><i class="fas fa-cogs"></i> Configurações</a> /
    <i class="fas fa-list"></i> DropDowns
  </h1>
  <!-- Content Row -->
  <div class="text-center">
    <h1 class="h3 mb-5 text-gray-800">DROP-DOWNS</h1>
  </div>

  <!-- Content Row -->
  <ul style="list-style-type:none;">
    <li>
      <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="lista_dropdown.php?id=1"><!--a variavel ID é sequencial-->
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Empresa</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-building fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="lista_dropdown.php?id=2">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Departamento</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-grip-horizontal fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
    </li>
  </ul>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">Ã—</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php' ?>