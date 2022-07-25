<?php

include '../config/conexaoSmart.php';
include '../config/sqlSmart.php';

//Editando regra Empresa Departamento

$updateEmpDep = "UPDATE empresa_departamento
                SET
                    gerente_aprova = '".$_POST['gerap']."',
                    superintendente_aprova = '".$_POST['supap']."',
                    situacao = '".$_POST['situacao']."'
                WHERE
                    id_empdep = '".$_GET['id_empdep']."'";

$resultUptEmpDep = ociparse($conn, $updateEmpDep);

if(ociexecute($resultUptEmpDep)) {
    header('location: ../front/smartshare_pag.php?id_drop=3&msn=2&id_usuario='. $_GET['id_usuario'] .''); //msn=2 Regra editada com sucesso.
}else{
    $e = oci_error($resultUpdateEmp);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($conn);

?>