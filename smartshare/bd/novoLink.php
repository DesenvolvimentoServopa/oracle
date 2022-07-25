<?php

require_once('../config/conexaoSmart.php');
require_once('../config/conexaoSmartSelbetti.php');

function sanitizeString($str) {
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    return $str;
}

$car = sanitizeString($_POST['descricao']);

$descricao = strtoupper($car);

$queryPerfil = "SELECT CD_PERFIL, DS_PERFIL FROM PERFIL WHERE CD_PERFIL = '".$_POST['cdPerfil']."'";
$resultadoPerfil = oci_parse($conns, $queryPerfil);
oci_execute($resultadoPerfil);
$perfil = oci_fetch_array($resultadoPerfil, OCI_BOTH);

oci_free_statement($resultadoPerfil);
oci_close($conns);

$insert = "INSERT INTO MFP_WEB (LINK, CD_PERFIL, DS_PERFIL, DESCRICAO) values 
('".$_POST['link']."', '".$_POST['cdPerfil']."', '".$perfil['DS_PERFIL']."', '".$descricao."')";

$resultInsert = oci_parse($conn, $insert);
$r = oci_execute($resultInsert);

if($r){
    oci_close($conn);
    header('Location: ../front/smartshare_pag.php?id_drop=13&id_usuario='.$_GET['id_usuario'].'&msn=1');
}else{
    $e = oci_error($resultInsert);   // For oci_connect errors do not pass a handle
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

?>