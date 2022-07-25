<?php
//chamando a header
include 'header.php';
//chamando sql's
include '../config/sqlSmart.php';
//chamando os bancos
include '../config/conexaoSmart.php';
include '../config/conexaoSmartSelbetti.php';

$queryUserApi .= "WHERE cd_usuario = ".$_GET['id']."";

$resultUserApi = ociparse($conns, $queryUserApi);
ociexecute($resultUserApi);

$rowUserApi = oci_fetch_array($resultUserApi,OCI_BOTH);
/* echo $queryUserApi; */
?>       
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

    <!-- Page Cabeçalho -->
    <title>Editar Usuário SmartShare</title>
    <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px;">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare.php?id_usuario=<?=$_GET['id_usuario']?>"><i class="fas fa-list"></i> SmartShare</a> /
        <i class="fas fa-user-plus"></i> Editar Usuario SmartShare
    </h1>

    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">EDITAR USUARIO SMARTSHARE</h1>
    </div>

    
    <div class="col-lg-6" style="margin-left: 25%;">
        <form id="editarUserSmartShare" name="editarUserSmartShare" method="POST" action="../bd/editUserApi.php?id=<?=$_GET['id']?>&id_usuario=<?= $_GET['id_usuario'] ?>">
            
            <!-- INICIO INPUT USUARIO -->
            <div class="form-group">
                <label for="inputUsuario">NOME USUARIO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" value="<?=$rowUserApi['DS_USUARIO']?>" name="inputUsuario" id="inputUsuario">    
            </div>
            <!-- FIM INPUT USUARIO -->

            <!-- INICIO INPUT EMAIL -->
            <div class="form-group">
                <label for="inputEmail">EMAIL USUARIO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" value="<?=$rowUserApi['DS_EMAIL']?>" name="inputEmail" id="inputEmail">    
            </div>
            <!-- FIM INPUT EMAIL -->

            <!-- INICIO INPUT LOGIN -->
            <div class="form-group">
                <label for="inputLogin">LOGIN SMARTSHARE:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" value="<?=$rowUserApi['DS_LOGIN']?>" name="inputLogin" id="inputLogin">    
            </div>
            <!-- FIM INPUT LOGIN -->

            <!-- BOTÃO SALVAR -->
            <a class="btn btn-danger" href="smartshare_pag.php?id_drop=7&id_usuario=<?=$_GET['id_usuario']?>">Voltar</a>
            <button class="btn btn-success" name="salvar" type="submit">Editar</button>
            <!-- BOTÃO SALVAR -->   

        </form>
    </div>
</div>

<?php include 'footer.php' ?>