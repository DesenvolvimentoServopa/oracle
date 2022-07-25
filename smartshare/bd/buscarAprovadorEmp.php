<?php
session_start();
//chamando banco
include '../config/conexaoSmartSelbetti.php';
//Query
include '../config/sqlSmart.php';

//sessões
$_SESSION['empresa'] = $_POST['empresa'];
$_SESSION['sistema'] = $_POST['sistema'];
$_SESSION['empApollo'] = $_POST['empApollo'];
$_SESSION['revApollo'] = $_POST['revApollo'];
$_SESSION['empnbs'] = $_POST['empnbs'];
$_SESSION['orgsenior'] = $_POST['orgsenior'];
$_SESSION['empresasenior'] = $_POST['empresasenior'];
$_SESSION['filialsenior'] = $_POST['filialsenior'];
$_SESSION['consorcio'] = $_POST['consorcio'];
$_SESSION['situacao'] = $_POST['situacao'];
$_SESSION['numero_caixa'] = $_POST['numero_caixa'];

$queryUserApi .= " AND ds_usuario like '%".strtoupper($_POST['aproCaixa'])."%' OR ds_login like '%".$_POST['aproCaixa']."%'";

echo $queryUserApi;
$resultadoUsuario = oci_parse($conns, $queryUserApi);
oci_execute($resultadoUsuario);

if(($usuario = oci_fetch_array($resultadoUsuario, OCI_BOTH)) != false) {

    switch ($_GET['acao']) {
        case '1'://editar
            header('Location: ../front/editemp.php?id_empresa='.$_GET['id_empresa'].'&id_usuario='.$_GET['id_usuario'].'&ds_usuario='.$usuario['DS_LOGIN'].'#liberarApro');
            break;
        
        default://adicionar
            header('Location: ../front/novaRegraEmp.php?id_usuario='.$_GET['id_usuario'].'&ds_usuario='.$usuario['DS_LOGIN'].'#liberarApro');
            break;
    }
}

oci_close($conns);

?>