<?php

//chamando a header
include 'header.php';

//chamando sql's
include '../config/sqlSmart.php';

//chamando banco
include '../config/conexaoSmart.php';
include '../config/conexaoSmartSelbetti.php';

echo'        
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

    <!-- Page Cabeçalho -->
    <title>Novo Aprovador Gestor Empresa</title>
    <h1 class="text-xs mb-6 text-gray-800 style="margin-left: 109px;"">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare.php?id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> SmartShare</a> /
        <i class="fas fa-user-plus"></i> Novo Aprovador Gestor Empresa
    </h1>

    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">NOVO APROVADOR GESTOR EMPRESA</h1>
    </div>

    
    <div class="col-lg-6" style="margin-left: 25%;">
        <form id="novoAprovadorFilial" name="novoAprovadorFilial" method="POST" action="../bd/novaRegraApFilial.php?id_usuario='.$_GET['id_usuario'].'">
            <div>
                <input style="display:none" name="id" value="2"/>  
            </div>

            <!-- INICIO DROP EMPRESA -->
            <div class="form-group">
                <label for="empresa">EMPRESA:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Empresa" name="empresa" id="empresa" required>';
                    //Mostra todas as empresas com a situação ativo      
                    $emp .= " WHERE e.situacao = 'A' ORDER BY NOME_EMPRESA ASC";

                    $resultEmpresa = ociparse($conn, $emp);
                    ociexecute($resultEmpresa);

                    echo'<option value="">---------------------</option>';
                    while (($rowEmpresa = oci_fetch_array($resultEmpresa, OCI_BOTH)) != FAlSE) {
                        echo '<option value="' . $rowEmpresa['ID_EMPRESA'] . '">' . $rowEmpresa['NOME_EMPRESA'] . '</option>';
                    }

                    echo'
                </select>
            </div>
            <!-- FIM DROP EMPRESA -->

            <!-- INICIO DROP APROVADOR GESTOR -->
            <div class="form-group">
                <label for="logins">APROVADOR GESTOR:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Aprovador Gestor" name="logins" type="text" id="logins" required>';
    
                    $resultuser = ociparse($conns, $query_user);
                    ociexecute($resultuser);

                    echo '<option value="">------------------</option>';
                    while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
                        echo '<option value="' . $rowuser['DS_LOGIN'] . '">' . $rowuser['DS_USUARIO'] . ' / '.$rowuser['DS_LOGIN'].'</option>';
                    }

                    echo'
                </select>
            </div>
            <!-- FIM DROP APROVADOR GESTOR  -->

            <!-- INICIO DROP SITUAÇÃO -->
            <div class="form-group">
                <label for="situacao">SITUAÇÃO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Situação"  name="situacao" type="text" id="situacao" required>
                    <option value="">------------------</option>         
                    <option value="A">ATIVADO</option> 
                    <option value="D">DESATIVADO</option> 
                </select>
            </div>
            <!-- FIM DROP SITUAÇÃO -->
            
            <!-- BOTÃO SALVAR -->
            <button class="btn btn-success" name="salvar" type="submit">Salvar</button>
            <a class="btn btn-danger" href="smartshare_pag.php?id_drop=6&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <!-- BOTÃO SALVAR -->   

        </form>
    </div>
</div>';

include 'footer.php'

?>