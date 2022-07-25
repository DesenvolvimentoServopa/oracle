<?php
session_start();
//chamar a header
include 'header.php';


if (isset($_GET['id_drop'])) {
    switch ($_GET['id_drop']) {
        case 1:
            echo '
                <!-- Page Heading -->
                <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px";>
                    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                    <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                    <i class="fas fa-building"></i></i> Empresa
                </h1>';
            break;
        case 2:
            echo '
                <!-- Page Heading -->
                <h1 class="text-xs mb-6 text-gray-800"  style="margin-left: 109px;";>
                    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                    <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                    <i class="fas fa-sitemap"></i> Departamentos RH
                </h1>';
            break;
        case 3:
            echo '
                <!-- Page Heading -->
                <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px";>
                    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                    <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                    <i class="fas fa-grip-horizontal"></i></i> Empresa X Departamento RH
                </h1>';
            break;
        case 4:
            echo '
                <!-- Page Heading -->
                <h1 class="text-xs mb-6 text-gray-800"  style="margin-left: 109px;";>
                    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                    <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                    <i class="fas fa-check-square"></i> Aprovadores
                </h1>';
            break;
        case 5:
            echo '
                <!-- Page Heading -->
                <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px";>
                    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                    <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                    <i class="fas fa-users"></i></i> Gestores Diretos
                </h1>';
            break;
        case 6:
            echo '
                    <!-- Page Heading -->
                    <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px";>
                        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                        <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                        <i class="fas fa-check"></i></i> Aprovador Filial
                    </h1>';
            break;
        case 7:
            echo '
                        <!-- Page Heading -->
                        <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px";>
                            <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                            <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                            <i class="fas fa-user"></i></i> Usuários Smartshare
                        </h1>';
            break;
        case 8:
            echo '
                    <!-- Page Heading -->
                    <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px";>
                        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                        <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                        <i class="fas fa-user-cog"></i></i> GESTOR RH
                    </h1>';
            break;
        case 9:
            echo '
                    <!-- Page Heading -->
                    <h1 class="text-xs mb-6 text-gray-800"  style="margin-left: 109px;";>
                        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                        <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                        <i class="fas fa-check-square"></i> Aprovadores NF
                    </h1>';
            break;
        case 10:
            echo '
                    <!-- Page Heading -->
                    <h1 class="text-xs mb-6 text-gray-800"  style="margin-left: 109px;";>
                        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                        <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                        <i class="fas fa-sitemap"></i> Departamentos NF
                    </h1>';
            break;
        case 11:
            echo '
                    <!-- Page Heading -->
                    <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px";>
                        <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                        <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                        <i class="fas fa-grip-horizontal"></i></i> Empresa X Departamento NF
                    </h1>';
            break;
        case 12:
            echo '
                        <!-- Page Heading -->
                        <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px";>
                            <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                            <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                            <i class="fas fa-user-cog"></i></i> GESTOR NF
                        </h1>';
            break;
        case 13:
            echo '
                            <!-- Page Heading -->
                            <h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px";>
                                <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
                                <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
                                <i class="fas fa-link"></i></i> MFP WEB
                            </h1>';
            break;
    }
} else {
    echo '<!-- Page Heading -->
        <h1 class="text-xs mb-6 text-gray-800"  style="margin-left: 109px;">
            <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
            <a href="smartshare.php?id_usuario=' . $_SESSION['id_usuario'] . '"><i class="fas fa-list"></i> BPMServopa</a> /
            <i class="fas fa-cog"></i> SmartShare Configurações
        </h1>';
}
?>

<!-- Begin Page Content -->
<div class="container">

    <body>
        <div class="container">
            <?php include 'selecao_smartshare_drop.php' ?>
        </div>
    </body>

    <?php
    include 'footer.php';
    ?>