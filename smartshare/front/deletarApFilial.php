<?php

//chamando a header
include 'header.php';

//chamando sql's
include '../config/sqlSmart.php';

//chamando os bancos
include '../config/conexaoSmart.php';
include '../config/conexaoSmartSelbetti.php';

echo'
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

    <!-- Page Cabeçalho -->
    <title>Deletar Regra Aprovador Gestor Empresa</title>
    <h1 class="text-xs mb-6 text-gray-800">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare_pag.php?id_drop=6&id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> Regras Aprovador Gestor Empresa</a> /
        <i class="fas fa-trash"></i> Deletar Regra Aprovador Gestor Empresa
    </h1>
    <body>
        <div class="text-center">
            <h1 class="h3 mb-4 text-gray-800">DELETAR REGRA APROVADOR GESTOR EMPRESA</h1>
        </div> 
                                                                                                
        <form id="deletarRegraGer" name="deletarRegraGer" method="POST" action="../bd/deletarApFilial.php?id_usuario='.$_GET['id_usuario'].'">
            <div class="card shadow mb-4">
                <div class="text-center">';

                    $queryAprovFilial .= " WHERE a.id_aprovador = ".$_GET['id']."";
                    
                    $resultAprovFilial = ociparse($conn, $queryAprovFilial);
                    ociexecute($resultAprovFilial);   

                    echo'            
                    <div class="card shadow mb-auto">
                        <div class="row" style="margin-left: 8px; margin-right: 8px;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id Regra</th>
                                        <th>Nome Empresa</th>
                                        <th>Aprovador Gestor Empresa</th>
                                        <th>Situação</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    while (($rowAprovFilial = oci_fetch_array($resultAprovFilial, OCI_BOTH)) != FAlSE) {

                                        $situacao = ($rowAprovFilial['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
                                        echo '<tr>';
                                        echo '<td>' . $rowAprovFilial['ID_APROVADOR'] . '</td>';
                                        echo '<td>' . $rowAprovFilial['NOME_EMPRESA'] . '</td>';
                                        echo '<td>' . $rowAprovFilial['APROVADOR_GESTOR'] . '</td>';
                                        echo '<td>' . $situacao . '</td>';
                                    echo '<td>
                                        </tr>';
                                    }
                                    echo '
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id Regra</th>
                                        <th>Nome Empresa</th>
                                        <th>Aprovador Gestor Empresa</th>
                                        <th>Situação</th>
                                    </tr>
                                </tfoot>                            
                            </table>
                        </div>
                    </div>
                </div>     
            </div>

            <!-- BOTÃO SALVAR --> 
            <div class="form-group" style="margin-left: 480px;">  
                <a class="btn btn-success" type="button" href="smartshare_pag.php?id_drop=6&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
                <button class="btn btn-danger" name="deletar" type="submit">Deletar</button>
            </div>
            <!-- BOTÃO SALVAR -->

        </form>            
    </body>
</div>';     

include 'footer.php';
?>