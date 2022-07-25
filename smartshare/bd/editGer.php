<?php

//chamando os bancos
include '../config/conexaoSmart.php';
include '../config/sqlSmart.php';

//Editando Regra Gestores
$updateRegraGes = " UPDATE gestor_direto
                SET
                    login_smartshare = '".$_POST['logins']."',
                    cpf_gestor = '".$_POST['cpfDoador']."',
                    situacao = '".$_POST['situacao']."'
                WHERE
                    id_gestor_direto = '".$_GET['id']."'";

$resultGes = ociparse($conn, $updateRegraGes);

if (ociexecute($resultGes)) {
    header('location: ../front/smartshare_pag.php?id_drop=5&msn=2&id_usuario='. $_GET['id_usuario'] .'');
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