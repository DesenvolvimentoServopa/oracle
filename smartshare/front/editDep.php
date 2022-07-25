<?php

//chamado o banco
include '../config/conexaoSmart.php';
include '../config/sqlSmart.php';

//chamando a header
include 'header.php';

$departrh .= " WHERE d.id_departamento = ".$_GET['id']."";

$resultdeprh = ociparse($conn, $departrh);
ociexecute($resultdeprh);

$rowdeprh = oci_fetch_array($resultdeprh, OCI_BOTH);

$situacao = ($rowdeprh['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';

if ($_GET['id'] != NULL) {

    echo'        
    <!-- INICIO DO CONTEUDO DA PÁGINA -->
        <div class="container">
    
        <!-- Page Cabeçalho -->
        <title>Editar Regra Departamento RH</title>
        <h1 class="text-xs mb-6 text-gray-800 style="margin-left: 109px;"">
            <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
            <a href="smartshare.php"><i class="fas fa-list"></i> SmartShare</a> /
            <i class="fas fa-user-plus"></i> Editar Regra Departamento RH
        </h1>
    
        <div class="text-center">
            <h1 class="h3 mb-4 text-gray-800">EDITAR REGRA DEPARTAMENTO RH</h1>
        </div>
    
        
        <div class="col-lg-6" style="margin-left: 25%;">
                                                                                                                                                  
            <form id="novaRegraDeptoRH" name="novaRegraDeptoRH" method="POST" action="../bd/editDep.php?id='.$_GET['id'].'&id_usuario=' .$_GET['id_usuario']. ' >
                <div>
                    <input style="display:none" name="id" value="2"/>  
                </div> 
                <!-- INICIO INPUT DEPARTAMENTOS RH -->   
                <div class="form-group">
                    <label for="nomedpto"">DEPARTAMENTO:</label>
                    <input type="text" class="form-control" value="'.$rowdeprh['NOME_DEPARTAMENTO'].'" name="nomedpto" id="nomedpto" placeholder="INSIRA NOVO DEPARTAMENTO" disabled>    
                </div>
                <!-- FIM INPUT DEPARTAMENTOS RH -->
    
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
                        <option value="'.$rowdeprh['SITUACAO'].'" selected>'.$situacao.'</option>
                        <option value="">------------------</option>
                        <option value="A">ATIVO</option> 
                        <option value="D">DESATIVADO</option> 
                    </select>
                </div>
                <!-- FIM DROP SITUAÇÃO -->
    
                <!-- BOTÃO SALVAR -->
                <button class="btn btn-success" name="salvar" type="submit">Salvar</button>
                <a class="btn btn-danger" href="smartshare_pag.php?id_drop=2&id_usuario=' .$_GET['id_usuario']. '">Voltar</a>
                <!-- BOTÃO SALVAR -->   
    
            </form>
        </div>
        </body>       
    ';
    
    }else{
        echo'erro';
    }

include 'footer.php'

?>