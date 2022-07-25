<?php
//chamando os bancos
include 'header.php';

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

include '../config/conexaoSmartSelbetti.php';

echo'
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

<!-- Page Cabeçalho -->
<title>Deletar Regra</title>
<h1 class="text-xs mb-6 text-gray-800">
    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
    <a href="smartshare_pag.php?id_drop=11&id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> Regras Empresa Deparmento NF</a> /
    <i class="fas fa-trash"></i> Deletar Regra Empresa Departamento NF
</h1>
<body>
    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">DELETAR REGRA EMPRESA X DEPARTAMENTO NF</h1>
    </div> 
                                                                                                                                                                                    
    <form clas="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="deletarRegraEmpDep" name="deletarRegraEmpDep" method="POST" action="../bd/deletarEmpDepNF.php?id='.$_GET['id'].'&id_usuario='.$_GET['id_usuario'].'" class="form-group" required>
        <div class="card shadow mb-4">
            <div class="text-center">';

            $empdepNF .= " WHERE e.id_empdep = ".$_GET['id']."";
                
                $resultempdep = ociparse($conn, $empdepNF);
                ociexecute($resultempdep);   

                echo'            
                    <div class="card shadow mb-auto">
                        <div class="row" style="margin-left: 8px; margin-right: 8px;">
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Departamento</th>                        
                                    <th>Gerente Aprova</th>
                                    <th>Superintendente Aprova</th>
                                    <th>Situação</th>                                    
                                    <th>Lancar Multas</th>
                                </tr>
                            </thead>
                        <tbody>';
                    while (($rowempdep = oci_fetch_array($resultempdep, OCI_BOTH)) != FAlSE) {

                        $situacao = ($rowempdep['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
                        $gerAp = ($rowempdep['GERENTE_APROVA'] == 'S') ? 'SIM' : 'NÃO';
                        $supAp = ($rowempdep['SUPERINTENDENTE_APROVA'] == 'S') ? 'SIM' : 'NÃO';                        
                        $lanca = ($rowempdep['LANCA_MULTAS'] == 'S') ? 'SIM' : 'NÃO';
                        echo '<tr>';
                        echo '<td>' . $rowempdep['NOME_EMPRESA'] . '</td>';
                        echo '<td>' . $rowempdep['NOME_DEPARTAMENTO'] . '</td>';            
                        echo '<td>' . $gerAp . '</td>';
                        echo '<td>' . $supAp . '</td>';
                        echo '<td>' . $situacao . '</td>';                        
                        echo '<td>' . $lanca . '</td>';
                        echo '<td>
                            </tr>';
                    }
                    echo '
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Empresa</th>
                                <th>Departamento</th>                        
                                <th>Gerente Aprova</th>
                                <th>Superintendente Aprova</th>
                                <th>Situação</th>
                                <th>Lancar Multas</th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div>  
                </div>
            </div>     
        </div>

        <!-- BOTÃO SALVAR -->
        <div class="form-group" style="margin-left: 480px;">    
            <a class="btn btn-success btn-user" type="button" href="smartshare_pag.php?id_drop=11&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <button class="btn btn-danger" name="deletar" type="submit">Deletar</button>
        </div>
        <!-- BOTÃO SALVAR -->

        </form>
        </div>
    </body>';

include 'footer.php';
?>