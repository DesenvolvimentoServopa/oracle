<?php

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

//Deletando regra
$deleteEmpDep = "DELETE FROM empresa_departamento
                    WHERE
                        id_empdep = '".$_GET['id']."'";

$resultDelEmpDep = oci_parse($conn, $deleteEmpDep);

if (oci_execute($resultDelEmpDep)) {
    header('location: ../front/smartshare_pag.php?id_drop=3&msn=3&id_usuario='.$_GET['id_usuario'].'');//msn=2 deletado com sucesso
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