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
    <a href="smartshare_pag.php?id_drop=1&id_usuario='.$_GET['id_usuario'].'"><i class="fas fa-list"></i> Regras Empresa</a> /
    <i class="fas fa-trash"></i> Deletar Regra Empresa
</h1>
<body>
    <div class="text-center">
        <h1 class="h3 mb-4 text-gray-800">DELETAR REGRA EMPRESA</h1>
    </div> 

    <form clas="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="deletarRegraEmp" name="deletarRegraEmp" method="POST" action="../bd/deletarEmp.php?id='.$_GET['id'].'&id_usuario='.$_GET['id_usuario'].'" class="form-group" required>
        <div class="card shadow mb-4">
            <div class="text-center">';

            $emp .= " WHERE e.id_empresa = ".$_GET['id']."";
                
                $resultemp = ociparse($conn, $emp);
                ociexecute($resultemp);

                echo'            
                    <div class="card shadow mb-auto">
                        <div class="row" style="margin-left: 8px; margin-right: 8px;">
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Sistema</th>
                                    <th>Empresa Apollo</th>
                                    <th>Revenda Apollo</th>
                                    <th>Empresa NBS</th>
                                    <th>Organograma Senior</th>
                                    <th>Empresa Senior</th>
                                    <th>Filial Senior</th>
                                    <th>Consórcio</th>
                                </tr>
                            </thead>
                        <tbody>';
                    while (($rowemp = oci_fetch_array($resultemp, OCI_BOTH)) != FAlSE) {                        
                
                        $consorcio = ($rowemp['CONSORCIO'] = 'S') ? 'SIM' : 'NÃO';

                        switch($rowemp['SISTEMA']){
                            case 'A': 
                                $sistema = 'APOLLO';
                            break;    
                            case 'N':
                                $sistema = 'NBS';
                            break;
                            case 'H':
                                $sistema = 'BANCO HARLEY';
                            break;
                            case ' ':
                                $sistema = 'NÃO USA E.R.P';
                            break;
                        }  

                        echo '<tr>';
                        echo '<td>' . $rowemp['NOME_EMPRESA'] . '</td>';
                        echo '<td>' . $sistema . '</td>';
                        echo '<td>' . $rowemp['EMPRESA_APOLLO'] . '</td>';
                        echo '<td>' . $rowemp['REVENDA_APOLLO'] . '</td>';
                        echo '<td>' . $rowemp['EMPRESA_NBS'] . '</td>';
                        echo '<td>' . $rowemp['ORGANOGRAMA_SENIOR'] . '</td>';
                        echo '<td>' . $rowemp['EMPRESA_SENIOR'] . '</td>';
                        echo '<td>' . $rowemp['FILIAL_SENIOR'] . '</td>';
                        echo '<td>' . $consorcio . '</td>';
                        echo '<td>
                            </tr>';
                    }
                    echo '
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Empresa</th>
                                <th>Sistema</th>
                                <th>Empresa Apollo</th>
                                <th>Revenda Apollo</th>
                                <th>Empresa NBS</th>
                                <th>Organograma Senior</th>
                                <th>Empresa Senior</th>
                                <th>Filial Senior</th>
                                <th>Consórcio</th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div>  
                </div>
            </div>     
        </div>

        <!-- BOTÃO SALVAR -->
        <div class="form-group" style="margin-left: 480px;">    
            <a class="btn btn-success btn-user" type="button" href="smartshare_pag.php?id_drop=1&id_usuario='.$_GET['id_usuario'].'">Voltar</a>
            <button class="btn btn-danger" name="deletar" type="submit">Deletar</button>
        </div>
        <!-- BOTÃO SALVAR -->

        </form>
        </div>
    </body>';

include 'footer.php';
?>