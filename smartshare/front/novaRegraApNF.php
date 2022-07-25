<?php

include 'header.php';

//chamando os bancos
include '../config/conexaoSmart.php';
include '../config/sqlSmart.php';
include '../config/conexaoSmartSelbetti.php';

echo'
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

<!-- Page Cabeçalho -->
<title>Nova Regra Aprovadores NF</title>
<h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px;">
    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
    <a href="smartshare.php?id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> SmartShare</a> /
    <i class="fas fa-user-plus"></i> Nova Regra Aprovadores NF
</h1>

<div class="text-center">
    <h1 class="h3 mb-4 text-gray-800">NOVA REGRA APROVADORES NF</h1>
</div>

<div class="col-lg-6" style="margin-left: 25%;">                                                                                                                                                                                                                                    
    <form id="novaRegraEmpresa" name="novaRegraEmpresa" method="POST" action="../bd/novaRegraApNF.php?id_usuario='. $_GET['id_usuario'] .'">

        <!-- INICIO DROP EMPRESA -->    
        <div class="form-group">
            <label for="empresa">EMPRESA:
                <span>
                    <a href="javascript:" title="Campo obrigatório" style="color:red;">
                        <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                    </a>
                </span>
            </label>
            <input type="text" id="id_usuario" name="id_usuario" style="display:none" value="'.$_GET['id_usuario'].'">
            <select class="form-control" onchange="empresaSelect()" placeholder="Empresa" name="empresa" id="empresa" required>';
                
            if (!empty($_GET['empresa'])) {
                $emp .= " WHERE e.id_empresa = " . $_GET['empresa'] . "ORDER BY e.nome_empresa ASC";

                $resultEmpresa = ociparse($conn, $emp);
                ociexecute($resultEmpresa);

                while (($rowEmpresa = oci_fetch_array($resultEmpresa, OCI_BOTH)) != FAlSE) {
                    echo '<option value="' . $rowEmpresa['ID_EMPRESA'] . '" selected>' . $rowEmpresa['NOME_EMPRESA'] . '</option>';
                }

                echo '<option>------------------</option>';

                $resultEmpresaNew = ociparse($conn, $empNew);
                ociexecute($resultEmpresaNew);

                while (($rowEmpresaNew = oci_fetch_array($resultEmpresaNew, OCI_BOTH)) != FAlSE) {
                    echo '<option value="' . $rowEmpresaNew['ID_EMPRESA'] . '">' . $rowEmpresaNew['NOME_EMPRESA'] . '</option>';
                }
            } else {
                echo '<option>EMPRESA</option>
                            <option>------------------</option>';

                $resultEmpresa = ociparse($conn, $emp);
                ociexecute($resultEmpresa);

                while (($rowEmpresa = oci_fetch_array($resultEmpresa, OCI_BOTH)) != FAlSE) {
                    echo '<option value="' . $rowEmpresa['ID_EMPRESA'] . '">' . $rowEmpresa['NOME_EMPRESA'] . '</option>';
                }
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

                if (!empty($_GET['empresa'])) {

                    if ($_GET['depto'] == NULL) {
                        echo '<option value="">------------------</option>';
                        
                        //Inicio da lista de todos os departamentos(menos o 41) independete da empresa
                        $empdepNF .= " WHERE e.id_empresa = " . $_GET['empresa'] . " AND d.id_departamento != (41) ORDER BY d.nome_departamento ASC";

                        $resultDepartamento = ociparse($conn, $empdepNF);
                        ociexecute($resultDepartamento);

                        while (($rowDepartamento = oci_fetch_array($resultDepartamento, OCI_BOTH)) != FAlSE) {
                            echo '<option value="' . $rowDepartamento['ID_DEPARTAMENTO'] . '">' . $rowDepartamento['NOME_DEPARTAMENTO'] . '</option>';
                        }
                        //Fim da Lista
                    } else {
                        //Inicio da lista departamentos por empresa
                        $empdepNF .= " WHERE e.id_empresa = " . $_GET['empresa'] . " AND e.id_departamento = " . $_GET['depto'] . "";

                        $resultDepartamento = ociparse($conn, $empdepNF);
                        ociexecute($resultDepartamento);

                        while (($rowDepartamento = oci_fetch_array($resultDepartamento, OCI_BOTH)) != FAlSE) {
                            echo '<option value="' . $rowDepartamento['ID_DEPARTAMENTO'] . '">' . $rowDepartamento['NOME_DEPARTAMENTO'] . '</option>';
                        }
                        //Fim da lista
                        echo '<option value="">------------------</option>';
                        //Inicio da lista com o restante dos departamentos por empresa
                        $empdepNewNF .= " WHERE e.id_empresa = " . $_GET['empresa'] . " AND d.id_departamento != (41) ORDER BY d.nome_departamento ASC";

                        $resultDepartamentoNew = ociparse($conn, $empdepNew);
                        ociexecute($resultDepartamentoNew);

                        while (($rowDepartamentoNew = oci_fetch_array($resultDepartamentoNew, OCI_BOTH)) != FAlSE) {
                            echo '<option value="' . $rowDepartamentoNew['ID_DEPARTAMENTO'] . '">' . $rowDepartamentoNew['NOME_DEPARTAMENTO'] . '</option>';
                        }
                        //Fim da lista
                    }
                } else {
                    echo '<option value="">------------------</option>';
                }

                echo'  
            </select>
        </div>
        <!-- FIM DROP DEPARTAMENTO -->

        <!-- INICIO DROP CIENCIA FILIAL -->
        <div class="form-group">
            <label for="filial">CIÊNCIA FILIAL:
                <span>
                    <a href="javascript:" title="Campo obrigatório" style="color:red;">
                        <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                    </a>
                </span>
            </label>
            <select class="form-control" placeholder="Ciência Filial" name="filial" type="text" id="filial" required>';

                if (!empty($_GET['empresa'])) {

                    $resultuser = ociparse($conns, $query_user);
                    ociexecute($resultuser);

                    echo '<option value="">------------------</option>';

                    while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
                        echo '<option value="' . $rowuser['DS_LOGIN'] . '">' . $rowuser['DS_USUARIO'] . ' / '.$rowuser['DS_LOGIN'].'</option>';
                    }
                } else {
                    echo '<option value="">------------------</option>';
                }

            echo'
            </select>
        </div>
        <!-- FIM DROP CIENCIA FILIAL -->

        <!-- INICIO DROP CIENCIA AREA -->
        <div class="form-group">
            <label for="area">CIÊNCIA AREA:
                <span>
                    <a href="javascript:" title="Campo obrigatório" style="color:red;">
                        <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                    </a>
                </span>
            </label>
            <select class="form-control" placeholder="Ciência Area" name="area" type="text" id="area" required>';
                
                if (!empty($_GET['empresa'])) {

                    $resultuser = ociparse($conns, $query_user);
                    ociexecute($resultuser);

                    echo '<option value="">------------------</option>';

                    while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
                        echo '<option value="' . $rowuser['DS_LOGIN'] . '">' . $rowuser['DS_USUARIO'] . ' / '.$rowuser['DS_LOGIN'].'</option>';
                    }
                } else {
                    echo '<option value="">------------------</option>';
                }

            echo'    
            </select>
        </div>
        <!-- FIM DROP CIENCIA AREA -->

        <!-- INICIO DROP CIENCIA MARCA -->
        <div class="form-group">
            <label for="marca">CIÊNCIA MARCA:
                <span>
                    <a href="javascript:" title="Campo obrigatório" style="color:red;">
                        <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                    </a>
                </span>
            </label>
            <select class="form-control" placeholder="Ciência Marca" name="marca" type="text" id="marca" required>';
                
                if (!empty($_GET['empresa'])) {

                    $resultuser = ociparse($conns, $query_user);
                    ociexecute($resultuser);

                    echo '<option value="">------------------</option>';

                    while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
                        echo '<option value="' . $rowuser['DS_LOGIN'] . '">' . $rowuser['DS_USUARIO'] . ' / '.$rowuser['DS_LOGIN'].'</option>';
                    }
                } else {
                    echo '<option value="">------------------</option>';
                }

            echo'    
            </select>
        </div>
        <!-- FIM DROP CIENCIA MARCA -->

        <!-- INICIO DROP GERENTE -->
        <div class="form-group">
            <label for="gerente">GERENTE GERAL:
                <span>
                    <a href="javascript:" title="Campo obrigatório" style="color:red;">
                        <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                    </a>
                </span>
            </label>
            <select class="form-control" placeholder="GERENTE" name="gerente" type="text" id="gerente" required>';
                if (!empty($_GET['empresa'])) {

                    $resultuser = ociparse($conns, $query_user);
                    ociexecute($resultuser);

                    echo '<option value="">------------------</option>';

                    while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
                        echo '<option value="' . $rowuser['DS_LOGIN'] . '">' . $rowuser['DS_USUARIO'] . ' / '.$rowuser['DS_LOGIN'].'</option>';
                    }
                } else {
                    echo '<option value="">------------------</option>';
                }

                echo'    
            </select>
        </div>
        <!-- FIM DROP GERENTE -->

        <!-- INICIO DROP SUPERINTENDENTE -->
        <div class="form-group">
            <label for="super">SUPERINTENDENTE:
                <span>
                    <a href="javascript:" title="Campo obrigatório" style="color:red;">
                        <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                    </a>
                </span>
            </label>
            <select class="form-control" placeholder="SUPERINTENDENTE" name="super" type="text" id="super" required>';
                if (!empty($_GET['empresa'])) {

                    $resultuser = ociparse($conns, $query_user);
                    ociexecute($resultuser);

                    echo '<option value="">------------------</option>';

                    while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
                        echo '<option value="' . $rowuser['DS_LOGIN'] . '">' . $rowuser['DS_USUARIO'] . ' / '.$rowuser['DS_LOGIN'].'</option>';
                    }
                } else {
                    echo '<option value="">------------------</option>';
                }

                echo'                          
            </select>
        </div>
        <!-- FIM DROP SUPERINTENDENTE -->

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

        <!-- BOTÃO SALVAR -->
        <button class="btn btn-success" name="salvar" type="submit" >Salvar</button>
        <a class="btn btn-danger" href="smartshare_pag.php?id_drop=4&id_usuario='. $_GET['id_usuario'].'">Voltar</a>
        <!-- BOTÃO SALVAR -->

    </form>
</div>

<script>
    function empresaSelect() {
        document.novaRegraEmpresa.action = "novaRegraApNF.php"
        document.novaRegraEmpresa.method = "GET"
        document.novaRegraEmpresa.submit();
    }
</script>';

include 'footer.php'

?>