<?php
//chamando os bancos
include 'header.php';

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

include '../config/conexaoSmartSelbetti.php';

$empdep .= " WHERE e.id_empdep = ".$_GET['id_empdep']."";

$resultpes = ociparse($conn, $empdep);
ociexecute($resultpes);

$rowempdep = oci_fetch_array($resultpes,OCI_BOTH);

$situacao = ($rowempdep['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
$gerAp = ($rowempdep['GERENTE_APROVA'] == 'S') ? 'SIM' : 'NÃO';
$supAp = ($rowempdep['SUPERINTENDENTE_APROVA'] == 'S') ? 'SIM' : 'NÃO';

if ($_GET['id_empdep'] != null) {

echo'
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

<!-- Page Cabeçalho -->
<title>Nova Regra Empresa</title>
<h1 class="text-xs mb-6 text-gray-800 style="margin-left: 109px;"" style="margin-left: 109px;">
    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
    <a href="smartshare.php"><i class="fas fa-list"></i> SmartShare</a> /
    <i class="fas fa-user-plus"></i> Editar Regra Empresa Departamento
</h1>

<div class="text-center">
    <h1 class="h3 mb-4 text-gray-800">EDITAR REGRA EMPRESA X DEPARTAMENTO</h1>
</div>

<div class="col-lg-6" style="margin-left: 25%;">                                                                                                                                                                                                                          
    <form id="novaRegraEmpDep" name="novaRegraEmpDep" method="POST" action="../bd/editEmpDep.php?id_empdep='.$_GET['id_empdep'].'&id_usuario='. $_SESSION['id_usuario'] .'">
        <div>
            <input style="display:none" name="id" value="4"/>  
        </div>    
        
        <!-- INICIO DROP EMPRESA -->
        <div class="form-group">
            <label for="empresa">EMPRESA:</label>
            <select class="form-control" placeholder="Empresa" name="empresa" id="empresa" required disabled>
                <option value="'.$rowempdep['ID_EMPRESA'].'" selected>'.$rowempdep['NOME_EMPRESA'].'</option>
            </select>
        </div>
        <!-- FIM DROP EMPRESA -->

        <!-- INICIO DROP DEPARTAMENTO -->
        <div class="form-group">
            <label for="depto">DEPARTAMENTO:</label>
            <select class="form-control" placeholder="Departamento" name="depto" type="text" id="depto" required disabled>
                <option value="'.$rowempdep['ID_DEPARTAMENTO'].'" selected>'.$rowempdep['NOME_DEPARTAMENTO'].'</option>
            </select>
        </div>
        <!-- FIM DROP DEPARTAMENTO -->

        <!-- INICIO DROP GERENTE APROVA -->
        <div class="form-group">
            <label for="gerap">GERENTE APROVA:                
                <span>
                    <a href="javascript:" title="Campo obrigatório" style="color:red;">
                        <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                    </a>
                </span>
            </label>
            <select class="form-control" placeholder="Gerente Aprova"  name="gerap" type="text" id="gerap" required>
                <option value="'.$rowempdep['GERENTE_APROVA'].'" selected>'.$gerAp.'</option>
                <option value="">---------------------</option>
                <option value="S">SIM</option> 
                <option value="N">NÃO</option> 
            </select>
        </div>
        <!-- FIM DROP GERENTE APROVA -->

        <!-- INICIO DROP SUPERINTENDENTE APROVA -->
        <div class="form-group">
            <label for="supap">SUPERINTENDENTE APROVA:
                <span>
                    <a href="javascript:" title="Campo obrigatório" style="color:red;">
                        <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                    </a>
                </span>
            </label>
            <select class="form-control" placeholder="Superintendente Aprova"  name="supap" type="text" id="supap" required>
                <option value="'.$rowempdep['SUPERINTENDENTE_APROVA'].'">'.$supAp.'</option>
                <option value="">---------------------</option>
                <option value="S">SIM</option> 
                <option value="N">NÃO</option> 
            </select>
        </div>
        <!-- FIM DROP GERENTE APROVA -->

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
                <option value="'.$rowempdep['SITUACAO'].'" selected>'.$situacao.'</option>
                <option value="">------------------</option>
                <option value="A">ATIVO</option> 
                <option value="D">DESATIVADO</option> 
            </select>
        </div>
        <!-- FIM DROP SITUAÇÃO -->

        <!-- BOTÃO SALVAR -->
        <button class="btn btn-success" name="salvar" type="submit">Salvar</button>
        <a class="btn btn-danger" href="smartshare_pag.php?id_drop=3&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
        <!-- BOTÃO SALVAR -->

    </form>
</div>';

}else{      
    echo'é';
}

include 'footer.php'

?>