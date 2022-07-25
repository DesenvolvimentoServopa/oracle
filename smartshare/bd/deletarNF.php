<?php

include '../config/conexaoSmart.php';

//Deletando regra
$deleteAp = " DELETE FROM aprovadores_nf
            WHERE
                id_aprovador =  '".$_GET['id']."'";

$resultDelAp = oci_parse($conn, $deleteAp);

if (oci_execute($resultDelAp)) {    
    header('location: ../front/smartshare_pag.php?id_drop=9&msn=3&id_usuario='. $_GET['id_usuario'] .'');//msn=2 deletado com sucesso
}else{
    $e = oci_error($resultdep);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($conn); 

?>

