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
    <a href="smartshare_pag.php?id_drop=4&id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> Regras Aprovadores</a> /
    <i class="fas fa-trash"></i> Deletar Regra Aprovadores
</h1>
<body>
    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">DELETAR REGRA APROVADORES</h1>
    </div> 

    <form clas="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="deletarRegra" name="deletarRegra" method="POST" action="../bd/deletar.php?id='.$_GET['id'].'&id_usuario='. $_GET['id_usuario'] .'" class="form-group" required>
        <div class="card shadow mb-4">
            <div class="text-center">';

            $aprov .= " AND id_aprovador = " .$_GET['id']. "";
                
                $resultaprov = ociparse($conn, $aprov);
                ociexecute($resultaprov);   

                echo'            
                    <div class="card shadow mb-auto">
                        <div class="row" style="margin-left: 8px; margin-right: 8px;">
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Id Regra</th>
                                    <th scope="col">Empresa</th>                                         
                                    <th scope="col">Departamento</th>                        
                                    <th scope="col">Area</th>
                                    <th scope="col">Filial</th>
                                    <th scope="col">Marca</th>                        
                                    <th scope="col">Gerente Geral</th>
                                    <th scope="col">Superintendente</th>
                                </tr>
                            </thead>
                        <tbody>';
                while (($rowaprov = oci_fetch_array($resultaprov, OCI_BOTH)) != FAlSE) {
                    echo '<tr>';
                    echo '<td>' . $rowaprov['ID_APROVADOR'] . '</td>';
                    echo '<td>' . $rowaprov['NOME_EMPRESA'] . '</td>';
                    echo '<td>' . $rowaprov['NOME_DEPARTAMENTO'] . '</td>';
                    echo '<td>' . $rowaprov['APROVADOR_AREA'] . '</td>';
                    echo '<td>' . $rowaprov['APROVADOR_FILIAL'] . '</td>';
                    echo '<td>' . $rowaprov['APROVADOR_MARCA'] . '</td>';
                    echo '<td>' . $rowaprov['APROVADOR_GERENTE'] . '</td>';
                    echo '<td>' . $rowaprov['APROVADOR_SUPERINTENDENTE'] . '</td>';
                    echo '
                        </tr>';
                } 
                echo '
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">Id Regra</th>
                                <th scope="col">Empresa</th>                                        
                                <th scope="col">Departamento</th>                        
                                <th scope="col">Area</th>
                                <th scope="col">Filial</th>
                                <th scope="col">Marca</th>                        
                                <th scope="col">Gerente Geral</th>
                                <th scope="col">Superintendente</th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div>  
                </div>
            </div>     
        </div>

        <!-- BOTÃO SALVAR -->
        <div class="form-group" style="margin-left: 480px;">    
            <a class="btn btn-success btn-user" type="button" href="smartshare_pag.php?id_drop=4&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <button class="btn btn-danger" name="deletar" type="submit">Deletar</button>
        </div>
        <!-- BOTÃO SALVAR -->

        </form>
        </div>
    </body>';

include 'footer.php';
?>