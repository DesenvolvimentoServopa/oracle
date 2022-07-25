<?php

include '../config/conexaoSmart.php';

//Deletando Gestor
$deleteGer = " DELETE FROM gestor_direto
            WHERE
                id_gestor_direto =  '".$_GET['id']."'";

$resultDelGer = oci_parse($conn, $deleteGer);
if (oci_execute($resultDelGer)) {
    header('location: ../front/smartshare_pag.php?id_drop=5&msn=3&id_usuario='.$_GET['id_usuario'].'');//msn=3 deletado com sucesso
}else{
    $e = oci_error($resultDelGer);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($conn);

?>