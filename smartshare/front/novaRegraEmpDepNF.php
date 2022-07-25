<?php
session_start();

//chamando os bancos
include 'header.php';

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

include '../config/conexaoSmartSelbetti.php';

echo'        
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

    <!-- Page Cabeçalho -->
    <title>Nova Regra Empresa Departamento NF</title>
    <h1 class="text-xs mb-6 text-gray-800 style="margin-left: 109px;"">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare.php?id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> SmartShare</a> /
        <i class="fas fa-user-plus"></i> Nova Regra Empresa Departamento NF
    </h1>

    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">NOVA REGRA EMPRESA X DEPARTAMENTO NF</h1>
    </div>

    <div class="col-lg-6" style="margin-left: 25%;">                                                                                                             
        <form id="novaRegraEmpDep" name="novaRegraEmpDep" method="POST" action="../bd/novaRegraEmpDepNF.php?id_usuario='.$_GET['id_usuario'].'" class="form-group">
            <div>
                <input style="display:none" name="id" value="4"/>  
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

            <!-- INICIO DROP DEPARTAMENTO -->
            <div class="form-group">
                <label for="depto">DEPARTAMENTO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Departamento" name="depto" type="text" id="depto" required>';
                    //Monstrar todos os departamentos com a situação ativo
                    $departNF .= " WHERE d.situacao = 'A' ORDER BY NOME_DEPARTAMENTO ASC";

                    $resultDpto = oci_parse($conn, $departNF);
                    ociexecute($resultDpto);

                    echo'<option value="">---------------------</option>';
                    while(($rowDpto = oci_fetch_array($resultDpto, OCI_BOTH)) != FALSE) {
                        echo '<option value="' . $rowDpto['ID_DEPARTAMENTO'] .'">' . $rowDpto['NOME_DEPARTAMENTO'] . '</option>';
                    }
                    echo' 
                </select>
            </div>
            <!-- FIM DROP DEPARTAMENTO -->

            <!-- INICIO DROP GERENTE APROVA -->
            <div class="form-group">
                <label for="situacao">GERENTE APROVA:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Gerente Aprova"  name="gerap" type="text" id="gerap" required>
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
                    <option value="">---------------------</option>
                    <option value="S">SIM</option> 
                    <option value="N">NÃO</option> 
                </select>
            </div>
            <!-- FIM DROP SUPERINTENDENTE APROVA -->

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
                    <option value="">---------------------</option>
                    <option value="A">ATIVO</option> 
                    <option value="D">DESATIVADO</option> 
                </select>
            </div>
            <!-- FIM DROP SITUAÇÃO -->

            <!-- INICIO LANCAR MULTAS-->
            <div class="form-group">
                <label for="situacao">LANÇAR MULTAS:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" name="lancarMulta" type="text" id="lancarMulta" required>
                    <option value="">---------------------</option>
                    <option value="S">SIM</option> 
                    <option value="N">NÃO</option> 
                </select>
            </div>
            <!-- FIM LANCAR MULTAS -->
            

            <!-- BOTÃO SALVAR -->
            <button class="btn btn-success" name="salvar" type="submit" >Salvar</button>
            <a class="btn btn-danger" href="smartshare_pag.php?id_drop=11&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <!-- BOTÃO SALVAR -->

        </form>
    </div>';

include 'footer.php'
?>