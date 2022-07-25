<?php

//chamado o banco
include '../config/conexaoSmart.php';
include '../config/conexaoSmartSelbetti.php';
include '../config/sqlSmart.php';

//chamando a header
include 'header.php';

$gesdir .=  " WHERE g.id_gestor_direto = ".$_GET['id']."";

$resultger = ociparse($conn, $gesdir);
ociexecute($resultger);

$rowges = oci_fetch_array($resultger,OCI_BOTH); 

$situacao = ($rowges['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';

if ($_GET['id'] != NULL) {

    echo'
    <!-- INICIO DO CONTEUDO DA PÁGINA -->
    <div class="container">

    <!-- Page Cabeçalho -->
    <title>Editar Regra</title>
    <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px;">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare.php?id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> SmartShare</a> /
        <i class="fas fa-user-plus"></i> Editar regra
    </h1>

    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">EDIÇÃO REGRA GESTORES</h1>
    </div>

    <div class="col-lg-6" style="margin-left: 25%;">                                                                                                
        <form id="editGer" name="editGer" method="POST" action="../bd/editGer.php?id='.$_GET['id'].'&id_usuario='. $_GET['id_usuario'] .'">

            <!-- INICIO DROP EMPRESA -->    
            <div class="form-group">
                <label for="empresa">EMPRESA:</label>
                <select class="form-control" placeholder="Empresa" name="empresa" id="empresa" disabled>
                    <option value="'.$rowges['ID_EMPRESA'].'" selected>'.$rowges['NOME_EMPRESA'].'</option>
                    <option>------------------</option>   
                </select>
            </div>
            <!-- FIM DROP EMPRESA -->            
            
            <!-- INICIO DROP DEPARTAMENTO -->
            <div class="form-group">
                <label for="depto">DEPARTAMENTO:</label>
                <select class="form-control" placeholder="Departamento" name="depto" type="text" id="depto" disabled>
                    <option value="'.$rowges['ID_DEPARTAMENTO'].'" selected>'.$rowges['NOME_DEPARTAMENTO'].'</option>
                    <option>------------------</option>
                </select>
            </div>
            <!-- FIM DROP DEPARTAMENTO -->
            
            <!-- INICIO DROP LOGIN SMARTSHARE -->
            <div class="form-group">
                <label for="logins"">LOGIN SMARTSHARE:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Login Smartshare" name="logins" type="text" id="logins" required>';
                    
                    $queryLogin = "Select * FROM usuario WHERE ds_login='".$rowges['LOGIN_SMARTSHARE']."'"; 

                    $resultQueryLogin = ociparse($conns, $queryLogin);
                    ociexecute($resultQueryLogin);

                    if (($rowQueryGer = oci_fetch_array($resultQueryLogin, OCI_BOTH)) != FALSE) {
                        echo'
                        <option value="'.$rowges['LOGIN_SMARTSHARE'].'">'.$rowQueryGer['DS_USUARIO'].' / '.$rowQueryGer['DS_LOGIN'].'</option>
                        <option>------------------</option>'; 
                    }

                    $resultuser = ociparse($conns, $query_user);
                    ociexecute($resultuser);

                    while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
                        echo '<option value="' . $rowuser['DS_LOGIN'] . '">' . $rowuser['DS_USUARIO'] . ' / '.$rowuser['DS_LOGIN'].'</option>';
                    }
                    echo' 
                </select>
            </div>
            <!-- FIM DROP LOGIN SMARTSHARE -->
        
            <!-- INICIO CPF GESTOR -->
            <div class="form-group">
                <label for="cpfDoador">CPF:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <input type="text" class="form-control" value="'.$rowges['CPF_GESTOR'].'" name="cpfDoador" id="cpfDoador" onkeydown="javascript: fMasc(this, mCPF );" maxlength="14" onblur="ValidarCPF(this)" placeholder="INSIRA NOVO CPF">    
            </div>
            <!-- FIM CPF GESTOR -->
            
            <!-- INICIO DROP SITUAÇÃO -->
            <div class="form-group">
                <label for="situacao">SITUAÇÃO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Situação" name="situacao" type="text" id="situacao" required> 
                    <option value="'.$rowges['SITUACAO'].'" selected>'.$situacao.'</option>   
                    <option>------------------</option>   
                    <option value="A">ATIVO</option>
                    <option value="D">DESATIVADO</option>
                </select>
            </div>
            <!-- FIM DROP SITUAÇÃO -->

            <!-- BOTÃO SALVAR -->
            <button class="btn btn-success" name="salvar" type="submit">Salvar</button>
            <a class="btn btn-danger" href="smartshare_pag.php?id_drop=5&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <!-- BOTÃO SALVAR -->

        </form>
    </div>';
        
}else{      
    echo'é';
}

include 'footer.php'

?>
    
