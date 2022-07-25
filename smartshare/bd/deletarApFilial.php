<?php

//chamando o banco
include '../config/conexaoSmart.php';

//Deletando Regra Aprovador Filial
$deleteAprovFilial = " DELETE FROM aprovadores_rh
                    WHERE
                        id_aprovador = '".$_GET['id']."'";

$resultDelAprovFilial = oci_parse($conn, $deleteAprovFilial);
if (oci_execute($resultDelAprovFilial)) {
    //msn=3 deletado com sucesso
    header('location: ../front/smartshare_pag.php?id_drop=6&msn=3&id_usuario='. $_GET['id_usuario'] .'');
}else{
    $e = oci_error($resultDelAprovFilial);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($conn);

?>