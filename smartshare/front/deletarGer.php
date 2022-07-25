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
    <a href="smartshare_pag.php?id_drop=5&id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> Regras Gestores</a> /
    <i class="fas fa-trash"></i> Deletar Regra Gestores
</h1>
<body>
    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">DELETAR REGRA GESTORES</h1>
    </div> 
                                                                                                                                                   
    <form clas="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="deletarRegraGer" name="deletarRegraGer" method="POST" action="../bd/deletarGer.php?id='.$_GET['id'].'&id_usuario='.$_GET['id_usuario'].'" class="form-group" required>
        <div class="card shadow mb-4">
            <div class="text-center">';

            $gesdir .= " WHERE g.id_gestor_direto = ".$_GET['id']."";
                
                $resultger = ociparse($conn, $gesdir);
                ociexecute($resultger);   

                echo'            
                    <div class="card shadow mb-auto">
                        <div class="row" style="margin-left: 8px; margin-right: 8px;">
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id Regra</th>
                                    <th>Empresa</th>
                                    <th>Departamento</th>
                                    <th>CPF Gestor</th>
                                    <th>Login SmartShare</th>
                                    <th>Situação<th>
                                </tr>
                            </thead>
                        <tbody>';
                        while (($rowgest = oci_fetch_array($resultger, OCI_BOTH)) != FAlSE) {

                            $situacao = ($rowgest['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
                            echo '<tr>';
                            echo '<td>' . $rowgest['ID_GESTOR_DIRETO'] . '</td>';
                            echo '<td>' . $rowgest['NOME_EMPRESA'] . '</td>';
                            echo '<td>' . $rowgest['NOME_DEPARTAMENTO'] . '</td>';
                            echo '<td>' . $rowgest['CPF_GESTOR'] . '</td>';
                            echo '<td>' . $rowgest['LOGIN_SMARTSHARE'] . '</td>';
                            echo '<td>' . $situacao . '</td>';
                        echo '<td>
                            </tr>';
                    }
                    echo '
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id Regra</th>
                                <th>Empresa</th>
                                <th>Departamento</th>
                                <th>CPF Gestor</th>
                                <th>Login SmartShare</th>
                                <th>Situação<th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div>  
                </div>
            </div>     
        </div>

        <!-- BOTÃO SALVAR -->
        <div class="form-group" style="margin-left: 480px;">    
            <a class="btn btn-success btn-user" type="button" href="smartshare_pag.php?id_drop=5&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <button class="btn btn-danger" name="deletar" type="submit">Deletar</button>
        </div>
        <!-- BOTÃO SALVAR -->

        </form>
        </div>
    </body>';

include 'footer.php';
?>