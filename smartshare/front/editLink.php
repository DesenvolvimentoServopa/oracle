<?php
//chamando os bancos
include 'header.php';

require_once('../config/conexaoSmart.php');
require_once('../config/conexaoSmartSelbetti.php');


$queryLink = "SELECT * FROM MFP_WEB WHERE ID_LINK = '" . $_GET['id_link'] . "'";
$resultadoLink = oci_parse($conn, $queryLink);
oci_execute($resultadoLink);
$link = oci_fetch_array($resultadoLink, OCI_BOTH);

$queryPerfilP = "SELECT CD_PERFIL, DS_PERFIL FROM PERFIL WHERE CD_PERFIL = '".$link['CD_PERFIL']."'";
$resultadoPerfilP = oci_parse($conns, $queryPerfilP);
oci_execute($resultadoPerfilP);
$perfiP = oci_fetch_array($resultadoPerfilP, OCI_BOTH);


?>
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

    <!-- Page Cabeçalho -->
    <title>Novo Link MFP WEB</title>
    <h1 class="text-xs mb-6 text-gray-800" style=" margin-left: 109px;">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare.php?id_usuario=<?= $_GET['id_usuario'] ?>"><i class="fas fa-list"></i> BPMservopa</a> /
        <i class="fas fa-pen"></i> Editar MFP WEB
    </h1>

    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">Editar MFP WEB</h1>
    </div>
    <div class="col-lg-6" style="margin-left: 25%;">
        <form id="novaRegraDeptoRH" name="novaRegraDeptoRH" method="POST" action="../bd/editLink.php?id_usuario=<?= $_GET['id_usuario'] ?>&id_link=<?= $_GET['id_link'] ?>">

            <!-- INICIO INPUT DEPARTAMENTOS RH -->
            <div class="form-group">
                <label for="nomedpto">Link:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="link" class="form-control" name="link" id="link" value="<?= $link['LINK'] ?>" required>
            </div>
            <!-- FIM INPUT DEPARTAMENTOS RH -->

            <!-- INICIO DROP SITUAÇÃO -->
            <div class="form-group">
                <label for="situacao">Código perfil:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" name="cdPerfil" type="text" id="codigoPerfil" required>
                    <option value="<?= $perfiP['CD_PERFIL']  ?>"><?= $perfiP['CD_PERFIL'] .' - ['.$perfiP['DS_PERFIL'].']'  ?></option>
                    <option value="">------------------</option>
                    <?php
                    $queryPerfil = "SELECT CD_PERFIL, DS_PERFIL FROM PERFIL WHERE st_ativo = 1";
                    $resultadoPerfil = oci_parse($conns, $queryPerfil);
                    oci_execute($resultadoPerfil);
                    while (($perfil = oci_fetch_array($resultadoPerfil, OCI_BOTH)) != false) {
                        echo '<option value="' . $perfil['CD_PERFIL'] . '">' . $perfil['CD_PERFIL'] . ' - [' . $perfil['DS_PERFIL'] . ']</option>';
                    }

                    ?>
                </select>
            </div>
            <!-- FIM DROP SITUAÇÃO -->
            <div class="form-group">
                <label for="situacao">Descrição: </label>
                <input type="text" class="form-control" name="descricao" id="descricao" maxlength="30" value="<?= $link['DESCRICAO'] ?>" required>
            </div>

            <!-- BOTÃO SALVAR -->
            <a class="btn btn-danger" href="smartshare_pag.php?id_drop=13&id_usuario=<?= $_GET['id_usuario'] ?>">Voltar</a>
            <button class="btn btn-info" type="submit">Editar</button>
            <!-- BOTÃO SALVAR -->
        </form>
    </div>
    </body>

    <?php
    include 'footer.php'
    ?>