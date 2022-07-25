<?php
//chamando os bancos
include 'header.php';

include '../config/conexaoSmart.php';

?>

<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">

    <!-- Page Cabeçalho -->
    <title>Deletar Regra</title>
    <h1 class="text-xs mb-6 text-gray-800">
        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
        <a href="smartshare_pag.php?id_drop=13&id_usuario=<?= $_GET['id_usuario'] ?>"><i class="fas fa-list"></i> BPMServopa</a> /
        <i class="fas fa-trash"></i> Deletar Link
    </h1>

    <body>
        <div class="text-center">
            <h1 class="h3 mb-4 text-gray-800">DELETAR LINK</h1>
        </div>

        <form clas="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="deletarRegraDpto" name="deletarRegraDpto" method="POST" action="../bd/deletarLink.php?id_link=<?= $_GET['id_link'] ?>&id_usuario=<?= $_GET['id_usuario'] ?>" class="form-group" required>
            <div class="card shadow mb-4">
                <div class="text-center">
                    <div class="card shadow mb-auto">
                        <div class="row" style="margin-left: 8px; margin-right: 8px;">
                            <table class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Link</th>
                                        <th>ID Perfil</th>
                                        <th>Perfil</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $queryMFP = "SELECT * FROM MFP_WEB WHERE ID_LINK = ".$_GET['id_link'];
                                    $resultMFP = oci_parse($conn, $queryMFP);
                                    oci_execute($resultMFP);

                                    while(($mfpWEB = oci_fetch_array($resultMFP, OCI_BOTH)) != false){
                                    echo '<tr>
                                            <td>'.$mfpWEB['LINK'].'</td>
                                            <td>'.$mfpWEB['CD_PERFIL'].'</td>
                                            <td>'.$mfpWEB['DS_PERFIL'].'</td>
                                            <td>'.$mfpWEB['DESCRICAO'].'</td>
                                        </tr>';
                                    }
                                    oci_close($conn);

                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Link</th>
                                        <th>ID Perfil</th>
                                        <th>Perfil</th>
                                        <th>Descrição</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOTÃO SALVAR -->
            <div class="form-group" style="margin-left: 480px;">
                <a class="btn btn-success btn-user" type="button" href="smartshare_pag.php?id_drop=13&id_usuario=<?=$_GET['id_usuario']?>">Voltar</a>
                <button class="btn btn-danger" name="deletar" type="submit">Deletar</button>
            </div>
            <!-- BOTÃO SALVAR -->

        </form>
</div>
</body>
<?php

include 'footer.php';
?>