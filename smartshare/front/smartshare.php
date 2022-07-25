<?php
//chamar a header
include 'header.php';
?>
<!-- Begin Page Content -->
<title>BPMServopa</title>
<div class="container">
  <!-- Page Heading -->
  <h1 class="text-xs mb-6 text-gray-800">
    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
    <i class="fas fa-list"></i> BPMServopa
  </h1>
  <!-- Content Row -->
  <div class="text-center">
    <h1 class="h5 mb-3 text-gray-800">BPMServopa</h1>
  </div>
  <ul style="list-style-type:none;">
    <li>
      <div class="row">

        <!-- Empresas -->
        <div class="col-xl-3 col-md-6 mb-4">
          <!--a variavel ID é sequencial-->
          <a href="smartshare_pag.php?id_drop=1&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Empresas</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-building fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Usuários SmartShare -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=7&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Usuários BPMServopa</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- MFP WEB -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=13&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">MFP WEB</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-link fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="text-center">
        <h1 class="h5 mb-3 text-gray-800">RH</h1>
      </div>

      <div class="row">

        <!-- Aprovadores RH -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=4&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Aprovadores RH</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user-check fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <!-- Departamentos RH -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=2&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Departamento RH</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Empresa X Departamento -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=3&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Empresa Departamento RH</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-grip-horizontal fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Aprovadores Filial -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=6&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Aprovador Filial</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-check fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div> -->

        <!-- Gestores Diretos -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=5&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Gestores Diretos</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div> -->

        <!-- SUBSTITUIÇÃO DE GESTOR-->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=8&id_usuario=<?= $_GET['id_usuario'] ?>&buscar=1">
            <div class="card border-left-dark shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">SUBSTITUIR GESTOR RH</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="text-center">
        <h1 class="h5 mb-3 text-gray-800">NF</h1>
      </div>

      <div class="row">

        <!-- Aprovadores NF -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=9&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Aprovadores NF</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user-check fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Departamento NF -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=10&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Departamento NF</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Empresa Departamento NF -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=11&id_usuario=<?= $_GET['id_usuario'] ?>">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Empresa Departamento NF</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-grip-horizontal fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- SUBSTITUIÇÃO DE GESTOR-->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="smartshare_pag.php?id_drop=12&id_usuario=<?= $_GET['id_usuario'] ?>&buscar=1">
            <div class="card border-left-dark shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">SUBSTITUIR GESTOR NF</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

    </li>
  </ul>

  <!-- Modal -->
  <div class="modal fade" id="config" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nova Configuração</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle fa-sm fa-fw mr-2 text-gray-400"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <form id="novaEmpresa" method="POST" action="../inc/cad_sistemas.php">
            <!--NOME-->
            <div class="form-group">
              <label for="inputEmail4">Nome: </label>
              <input type="text" class="form-control" name="nome">
            </div>
            <!--ENDEREÇO-->
            <div class="form-group">
              <label for="inputEmail4">Endereço: </label>
              <input type="text" class="form-control" name="endereco">
            </div>
            <!--ICONE FA ICON-->
            <div class="form-group">
              <label for="inputEmail4">Icone: </label>
              <input type="text" class="form-control" name="icone" placeholder="far fa-file-alt" required>
              <label class="text-xs" for="inputEmail4">lista de icones: <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free" target="_blank">https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free</a> </label>
            </div>
            <!--COR-->
            <div class="form-group">
              <label for="inputEmail4">Escolha uma Cor: </label>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="gridCheck" name="cor" value="primary">
                <label class="form-check-label" for="gridCheck">
                  <div class="px-3 py-2 bg-gradient-primary text-white"></div>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="gridCheck2" name="cor" value="success">
                <label class="form-check-label" for="gridCheck2">
                  <div class="px-3 py-2 bg-gradient-success text-white"></div>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="gridCheck3" name="cor" value="info">
                <label class="form-check-label" for="gridCheck3">
                  <div class="px-3 py-2 bg-gradient-info text-white"></div>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="gridCheck4" name="cor" value="success">
                <label class="form-check-label" for="gridCheck4">
                  <div class="px-3 py-2 bg-gradient-success text-white"></div>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="gridCheck5" name="cor" value="danger">
                <label class="form-check-label" for="gridCheck5">
                  <div class="px-3 py-2 bg-gradient-danger text-white"></div>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="gridCheck6" name="cor" value="secondary">
                <label class="form-check-label" for="gridCheck6">
                  <div class="px-3 py-2 bg-gradient-secondary text-white"></div>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="gridCheck7" name="cor" value="dark">
                <label class="form-check-label" for="gridCheck7">
                  <div class="px-3 py-2 bg-gradient-dark text-white"></div>
                </label>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>


<?php include 'footer.php' ?>