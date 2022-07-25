<?php

//chamando os bancos
include '../config/conexaoSmartSelbetti.php';
include '../config/sqlSmart.php';

$nomeUser = strtoupper($_POST['inputUsuario']);
$emailUser = strtolower($_POST['inputEmail']);
$loginUser = strtolower($_POST['inputLogin']);

//Editando Regra Usuario SmartShare
$updateUserApi = " UPDATE usuario
                SET
                    ds_usuario = '".$nomeUser."',
                    ds_email = '".$emailUser."',
                    ds_login = '".$loginUser."'
                WHERE
                    cd_usuario = '".$_GET['id']."'";

$resultUserApi = ociparse($conns, $updateUserApi);

if (ociexecute($resultUserApi)) {
    header('location: ../front/smartshare_pag.php?id_drop=7&msn=1&id_usuario='. $_GET['id_usuario'] .''); //msn != NUll = Editado com Sucesso!
}else{
    $e = oci_error($resultUserApi);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($conns);

?>