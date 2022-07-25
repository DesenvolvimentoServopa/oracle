<?php
session_start();

//chamando a header
include 'header.php';

//chamando sql's
include '../config/sqlSmart.php';

//chamando banco
include '../config/conexaoSmart.php';
include '../config/conexaoSmartSelbetti.php';

$idGestor = $_POST['idGestor'];

//COUNT PARA SABER QUANTAS OCORRENCIAS POSSUI OS FUNCIONÁRIOS

//ANTIGO GESTOR
$queryCount = "SELECT COUNT(*) as quantidade FROM aprovadores_rh WHERE 
                aprovador_filial = '".$idGestor ."' OR
                aprovador_area = '".$idGestor ."' OR
                aprovador_marca = '".$idGestor ."' OR
                aprovador_superintendente = '".$idGestor ."' OR
                aprovador_gerente = '".$idGestor ."' OR
                aprovador_gestor = '".$idGestor ."'";
$resultado = oci_parse($conn, $queryCount);
oci_execute($resultado);
$count = oci_fetch_array($resultado);

//NOVO GESTOR
$idGestorNovo = explode(' ', $_POST['gestorNovo'])[0];

$queryCountNovo = "SELECT COUNT(*) as quantidade FROM aprovadores_rh WHERE 
                aprovador_filial = '".$idGestorNovo ."' OR
                aprovador_area = '".$idGestorNovo ."' OR
                aprovador_marca = '".$idGestorNovo ."' OR
                aprovador_superintendente = '".$idGestorNovo ."' OR
                aprovador_gerente = '".$idGestorNovo ."' OR
                aprovador_gestor = '".$idGestorNovo ."'";
$resultadoNovo = oci_parse($conn, $queryCountNovo);
oci_execute($resultadoNovo);
$countNovo = oci_fetch_array($resultadoNovo);

?>
<!-- Page Heading -->
<h1 class="text-xs mb-6 text-gray-800" style="margin-left: 109px" ;>
    <a href="http://10.100.1.217/unico/front/sistemas.php"><i class="fas fa-home"></i> Home</a> /
    <a href="smartshare.php?id_usuario=<?= $_GET['id_usuario'] ?>"><i class="fas fa-list"></i> SmartShare</a> /
    <i class="fas fa-user-cog"></i></i> Atualizar Gestores Diretos
</h1>

<!-- INICIO DO CONTEUDO DA PÁGINA -->
<div class="container">
    <div class="col-lg-6" style="margin-left: 25%;">
        <form method="POST" action="../bd/atualizandoGestor.php?id_usuario=<?= $_GET['id_usuario'] ?>">
            <input type="text" name="gestorVelho" id="gestorVelho" value="<?= $idGestor ?>" style="display: none;">
            <input type="text" name="gestorNovo" id="gestorNovo" value="<?= $idGestorNovo ?>" style="display: none;">
            <!-- INICIO DROP EMPRESA -->
            <div class="form-group">
                <p style="text-align: center; color: red; font-size: 26px; margin-top: 12%;"><i class="fa-solid fa-triangle-exclamation"></i> ATENÇÃO! <i class="fa-solid fa-triangle-exclamation"></i></p>
                <p>Você esta preste a atualizar <b>TODAS</b> as <b>REGRAS</b> do <b>ANTIGO</b> gestor</p>
                <p style="text-align: center; background-color: #efe9ef; border-radius: 10px; padding: 5px;"><?= $_POST['gestorVelho'] ?> <b style="color: red; font-size: 10px">(<?= $count['QUANTIDADE'] ?> ocorrências)</b></p>
                <p>para o <b>NOVO</b> gestor</p>
                <p style="text-align: center; background-color: #efe9ef; border-radius: 10px; padding: 5px;"><?= $_POST['gestorNovo'] ?> <b style="color: red; font-size: 10px">(<?= $countNovo['QUANTIDADE'] ?> ocorrências)</b></p>
            </div>
            <div class="form-group">
                <p>após a confirmação não terá mais como reverter!</p>
                <!-- FIM DROP EMPRESA -->

                <!-- BOTÃO SALVAR -->
                <button class="btn btn-success" name="salvar" type="submit">CONFIRMAR, eu entendo os riscos</button>
                <a class="btn btn-danger" href="smartshare.php?id_usuario=<?= $_GET['id_usuario'] ?>">NÃO ATUALIZAR, me tire daqui</a>
                <!-- BOTÃO SALVAR -->

        </form>
    </div>
</div>

<?php
include 'footer.php';
?>