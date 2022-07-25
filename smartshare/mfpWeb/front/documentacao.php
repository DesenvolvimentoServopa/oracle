<html lang="pt-br">

<head>
    <meta charset="utf-8" http-equiv="X-UA-Compatible" content="IE=11">
    <title>Smartshare - MFP Web</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="../style.css">
</head>

<body onload="verificarDados()">
    <div class="shield with-navbar">
        <nav class="navbar fixed-top">
            <div class="container-session">
                <span class="navbar-brand"> Smartshare - LINKS</span>
            </div>
        </nav>
        <div class="main">
            <div class="has-grid">
                <?php

                require_once('../../config/conexaoSmart.php');
                require_once('../../config/conexaoSmartSelbetti.php');

                $usuario = $_POST['login'];

                if (!empty($usuario)) {
                    //encontrar ele dentro da selbetti para ver quais perfis ele possui

                    $queryEncontrarSelbetti = "SELECT CD_USUARIO FROM usuario WHERE ds_login LIKE '" . $usuario . "'";
                    $resultEncontrar = oci_parse($conns, $queryEncontrarSelbetti);
                    oci_execute($resultEncontrar);
                    $encontrei = oci_fetch_array($resultEncontrar, OCI_BOTH);

                    $queryEncontrarPerfil = "SELECT CD_PERFIL  FROM perfil_usuario WHERE cd_usuario = '" . $encontrei['CD_USUARIO'] . "'";
                    $resultEncontrarPerfil = oci_parse($conns, $queryEncontrarPerfil);
                    oci_execute($resultEncontrarPerfil);

                    while (($encontrarPerfil = oci_fetch_array($resultEncontrarPerfil, OCI_BOTH)) != false) {
                        $buscarLink = 'SELECT * FROM MFP_WEB where cd_perfil = ' . $encontrarPerfil['CD_PERFIL'] . '';
                        $resultLink = oci_parse($conn, $buscarLink);
                        oci_execute($resultLink);

                        while (($encontrarLink = oci_fetch_array($resultLink, OCI_BOTH)) != false) {


                            $verificarLink = substr($encontrarLink['LINK'], 0, 1);

                            if ($verificarLink == 'w') {
                                $link = 'http://' . $encontrarLink['LINK'];
                            } else {
                                $link = $encontrarLink['LINK'];
                            }

                            echo '<a href="' . $link . '" target="_blank">
                                        <div class="grid-item grid-item-outline colun-12" id="mfp">
                                            <div class="grid-text"> ' . $encontrarLink['DESCRICAO'] . ' </div>
                                        </div>
                                    </a>';
                        }
                    }
                } else {
                    header('location: ../index.php');
                }
                ?>
                <div class="grid-item colun-12" id="mfpNenhum">
                    <div class="grid-text">Nenhuma tela de MFP liberada para o seu perfil.</div>
                </div>

            </div>

        </div>
    </div>
    <footer copyrighttext="'This place should show name'" showuserinfo="true">
        <div class="navbar fixed-bottom">
            <div class="box-user-info" id="user-info">
                <span class="label-user-name">
                    Grupo Servopa - TI
                </span>
            </div>
            <a href="../index.php" class="btn btn-primary float-right" type="Submit" form="formLogin">
                VOLTAR
            </a>
        </div>
    </footer>
</body>

<script>
    function verificarDados() {
        var mfp = document.getElementById("mfp");

        if (mfp == null) {
            document.getElementById("mfpNenhum").style.display = 'block';
        }else{
            document.getElementById("mfpNenhum").style.display = 'none';
        }

    }
</script>
    <script src="../../js/seg.js" crossorigin="anonymous"></script>
</html>