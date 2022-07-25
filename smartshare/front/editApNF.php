<?php
//chamando os bancos
include 'header.php';

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

include '../config/conexaoSmartSelbetti.php';

$aprovNF .= " AND a.id_aprovador = " .$_GET['id_aprovador']."";

$resultpes = ociparse($conn, $aprovNF);
ociexecute($resultpes);

$rowaprovador = oci_fetch_array($resultpes,OCI_BOTH);

$situacao = ($rowaprovador['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';

if ($_GET['id_aprovador'] != null) {
    echo'
    <!-- INICIO DO CONTEUDO DA PÁGINA -->
    <div class="container">

    <!-- Page Cabeçalho -->
    <title>Editar Regra</title>
    <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px;">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare.php"><i class="fas fa-list"></i> SmartShare</a> /
        <i class="fas fa-user-plus"></i> Editar regra
    </h1>



    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">EDIÇÃO REGRA APROVADORES NF</h1>
    </div>

    <div class="col-lg-6" style="margin-left: 25%;">                                                                                               
        <form id="editAp" name="editAp" method="POST" action="../bd/editApNF.php?id_aprovador='.$_GET['id_aprovador'].'&id_usuario='.$_GET['id_usuario'].'">
            <!-- INICIO DROP EMPRESA -->    
            <div class="form-group">
                <label for="empresa">EMPRESA:</label>
                <select class="form-control" name="empresa" id="empresa" disabled>
                    <option value="'.$rowaprovador['NOME_EMPRESA'].'">'.$rowaprovador['NOME_EMPRESA'].'</option>   
                </select>
            </div>
            <!-- FIM DROP EMPRESA -->            
            
            <!-- INICIO DROP DEPARTAMENTO -->
            <div class="form-group">
                <label for="depto">DEPARTAMENTO:</label>
                <select class="form-control" name="depto" id="depto" disabled>
                    <option value="'.$rowaprovador['NOME_DEPARTAMENTO'].'">'.$rowaprovador['NOME_DEPARTAMENTO'].'</option>   
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
                    
                    $queryUserCF = "Select * FROM usuario WHERE ds_login='".$rowaprovador['APROVADOR_FILIAL']."'";

                    $resultEditUserCF = ociparse($conns, $queryUserCF);
                    ociexecute($resultEditUserCF);

                    if (($rowCifU = oci_fetch_array($resultEditUserCF, OCI_BOTH)) != FALSE) {
                        echo'
                        <option value="'.$rowaprovador['APROVADOR_FILIAL'].'">'.$rowCifU['DS_USUARIO'].' / '.$rowCifU['DS_LOGIN'].'</option>
                        ';
                    }

                    echo '<option value="">------------------</option>';
                    $resulteditcif = ociparse($conns, $query_user);
                    ociexecute($resulteditcif);

                    while (($rowcif = oci_fetch_array($resulteditcif, OCI_BOTH)) != FALSE) {
                        echo '<option value="'. $rowcif['DS_LOGIN'] . '">' . $rowcif['DS_USUARIO'] . ' / '. $rowcif['DS_LOGIN'] . '</option>';                                           
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
                
                    $queryUserCA = "Select * FROM usuario WHERE ds_login='".$rowaprovador['APROVADOR_AREA']."'";

                    $resultEditCiaS = ociparse($conns, $queryUserCA);
                    ociexecute($resultEditCiaS);                    

                    if (($rowciarea = oci_fetch_array($resultEditCiaS, OCI_BOTH)) != FALSE) {
                        echo'
                        <option value="'.$rowaprovador['APROVADOR_AREA'].'">'.$rowciarea['DS_USUARIO'].' / '.$rowciarea['DS_LOGIN'].'</option>
                        ';
                    }

                    echo '<option value="">------------------</option>';

                    $resulteditcia = ociparse($conns, $query_user);
                    ociexecute($resulteditcia);

                    while (($rowcia = oci_fetch_array($resulteditcia, OCI_BOTH)) != FALSE) {
                        echo '<option value="'.$rowcia['DS_LOGIN'].'">'.$rowcia['DS_USUARIO'].' / '.$rowcia['DS_LOGIN'].'</option>';                        
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
                    
                    $queryUserCM = "Select * FROM usuario WHERE ds_login='".$rowaprovador['APROVADOR_MARCA']."'"; 

                    $resultEditUserCM = ociparse($conns, $queryUserCM);
                    ociexecute($resultEditUserCM);

                    if (($rowCM = oci_fetch_array($resultEditUserCM, OCI_BOTH)) != FALSE) {
                        echo'
                        <option value="'.$rowaprovador['APROVADOR_MARCA'].'">'.$rowCM['DS_USUARIO'].' / '.$rowCM['DS_LOGIN'].'</option>
                        ';
                    }

                    echo '<option value="">------------------</option>';

                    $resulteditmar = ociparse($conns, $query_user);
                    ociexecute($resulteditmar);

                    while (($rowmar = oci_fetch_array($resulteditmar, OCI_BOTH)) != FALSE) {

                        echo'<option value="'.$rowmar['DS_LOGIN'].'">'.$rowmar['DS_USUARIO'].' / '.$rowmar['DS_LOGIN'].'</option>';                 
                    
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
                <select class="form-control" placeholder="GERENTE" name="gerente" type="text" id="gerente">';
                    
                    $queryUserGer = "Select * FROM usuario WHERE ds_login='".$rowaprovador['APROVADOR_GERENTE']."'"; 

                    $resultEditUserGer = ociparse($conns, $queryUserGer);
                    ociexecute($resultEditUserGer);

                    if (($rowUserGer = oci_fetch_array($resultEditUserGer, OCI_BOTH)) != FALSE) {
                        echo'
                        <option value="'.$rowaprovador['APROVADOR_GERENTE'].'">'.$rowUserGer['DS_USUARIO'].' / '.$rowUserGer['DS_LOGIN'].'</option>
                        ';
                    }

                    echo '<option value="">------------------</option>';

                    $resulteditger = ociparse($conns, $query_user);
                    ociexecute($resulteditger);

                    while (($rowger = oci_fetch_array($resulteditger, OCI_BOTH)) != FALSE) { 
                                            
                        echo'<option value="'.$rowger['DS_LOGIN'].'">'.$rowger['DS_USUARIO'].' / '.$rowger['DS_LOGIN'].'</option>';
                    
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
                    
                    $queryUserSup = "Select * FROM usuario WHERE ds_login='".$rowaprovador['APROVADOR_SUPERINTENDENTE']."'"; 

                    $resultEditSup = oci_parse($conns, $queryUserSup);
                    ociexecute($resultEditSup);

                    if (($rowUserSup = oci_fetch_array($resultEditSup, OCI_BOTH)) != FALSE) {
                        echo'
                        <option value="'.$rowaprovador['APROVADOR_SUPERINTENDENTE'].'">'.$rowUserSup['DS_USUARIO'].' / '.$rowUserSup['DS_LOGIN'].'</option>
                        ';
                    }

                    echo '<option value="">------------------</option>';

                    $resulteditsup = ociparse($conns, $query_user);
                    ociexecute($resulteditsup);

                    while (($roweditsup = oci_fetch_array($resulteditsup, OCI_BOTH)) != FALSE) {     
                                            
                        echo'<option value="'.$roweditsup['DS_LOGIN'].'">'.$roweditsup['DS_USUARIO'].' / '.$roweditsup['DS_LOGIN'].'</option>';
                    
                    }

                echo'                          
                </select>
            </div>
            <!-- FIM DROP SUPERINTENDENTE -->  
            
            <!-- INICIO DROP SITUAÇÃO -->
            <div class="form-group">
                <label for="marca">SITUAÇÃO:
                    <span>
                        <a href="javascript:" title="Campo obrigatório" style="color:red;">
                            <i class="fas fa-asterisk" style="margin-left: 73%;width: 2px;font-size: 10px;"></i>
                        </a>
                    </span>
                </label>
                <select class="form-control" placeholder="Situação" name="situacao" type="text" id="situacao" required> 
                    <option value="'.$rowaprovador['SITUACAO'].'" selected>'.$situacao.'</option>   
                    <option>------------------</option>   
                    <option value="A">ATIVO</option>
                    <option value="D">DESATIVADO</option>
                </select>
            </div>
            <!-- FIM DROP SITUAÇÃO -->

            <!-- BOTÃO SALVAR -->
            <button class="btn btn-success" name="salvar" type="submit">Salvar</button>
            <a class="btn btn-danger" href="smartshare_pag.php?id_drop=9&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <!-- BOTÃO SALVAR -->

        </form>
    </div>';
            
}else{      
    echo'é';
}

include 'footer.php'

?>