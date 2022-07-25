<?php
//Chamando os bancos
include '../config/conexaoSmart.php';
include '../config/sqlSmart.php';

//Editando Regra Departamento
$updateDep = " UPDATE departamento_nf
            SET
                situacao = '".$_POST['situacao']."'
            WHERE 
                id_departamento = '".$_GET['id']."'";

$resultdep = ociparse($conn, $updateDep);

 if(ociexecute($resultdep)){
    header('location: ../front/smartshare_pag.php?id_drop=10&msn=2&id_usuario='. $_GET['id_usuario'] .'');
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