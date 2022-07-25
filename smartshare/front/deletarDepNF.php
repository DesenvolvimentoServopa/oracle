<?php
//chamando os bancos
include 'header.php';

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';



echo'
<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

<!-- Page Cabeçalho -->
<title>Deletar Regra</title>
<h1 class="text-xs mb-6 text-gray-800">
    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
    <a href="smartshare_pag.php?id_drop=10&id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> Regras Departamento NF</a> /
    <i class="fas fa-trash"></i> Deletar Regra Departamento NF
</h1>
<body>
    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">DELETAR REGRA DEPARTAMENTO NF</h1>
    </div> 
                                                                                                                                                   
    <form clas="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="deletarRegraDpto" name="deletarRegraDpto" method="POST" action="../bd/deletarDepNF.php?id='.$_GET['id'].'&id_usuario='.$_GET['id_usuario'].'" class="form-group" required>
        <div class="card shadow mb-4">
            <div class="text-center">';
            $departNF .= " WHERE d.id_departamento = ".$_GET['id']."";
                
                $resultdpto = ociparse($conn, $departNF);
                ociexecute($resultdpto);   

                echo'            
                    <div class="card shadow mb-auto">
                        <div class="row" style="margin-left: 8px; margin-right: 8px;">
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id Regra</th>
                                    <th>Nome Departamento</th>
                                    <th>Situação Departamento</th>
                                </tr>
                            </thead>
                        <tbody>';
                        while (($rowdeprh = oci_fetch_array($resultdpto, OCI_BOTH)) != FAlSE) {

                            $situacao = ($rowdeprh['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
                            echo '<tr>';
                            echo '<td>' . $rowdeprh['ID_DEPARTAMENTO'] . '</td>';
                            echo '<td>' . $rowdeprh['NOME_DEPARTAMENTO'] . '</td>';
                            echo '<td>' . $situacao . '</td>';
                        echo '<td>
                            </tr>';
                    }
                    echo '
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id Regra</th>
                                <th>Nome Departamento</th>
                                <th>Situação Departamento</th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div>  
                </div>
            </div>     
        </div>

        <!-- BOTÃO SALVAR -->
        <div class="form-group" style="margin-left: 480px;">    
            <a class="btn btn-success btn-user" type="button" href="smartshare_pag.php?id_drop=10&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <button class="btn btn-danger" name="deletar" type="submit">Deletar</button>
        </div>
        <!-- BOTÃO SALVAR -->

        </form>
        </div>
    </body>';

include 'footer.php';
?>