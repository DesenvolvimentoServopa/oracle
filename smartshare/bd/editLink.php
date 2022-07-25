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

$update = "UPDATE MFP_WEB SET 
                link = '".$_POST['link']."', 
                cd_perfil='".$_POST['cdPerfil']."', 
                ds_perfil = '".$perfil['DS_PERFIL']."', 
                descricao = '".$descricao."'
            WHERE id_link = '".$_GET['id_link']."'";

$resultupdate = oci_parse($conn, $update);
$r = oci_execute($resultupdate);

if($r){
    oci_close($conn);
    header('Location: ../front/editLink.php?id_link='.$_GET['id_link'].'&id_usuario='.$_GET['id_usuario'].'');
}else{
    $e = oci_error($resultupdate);   // For oci_connect errors do not pass a handle
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

?>