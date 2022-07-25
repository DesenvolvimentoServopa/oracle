<?php

//chamando banco
include '../config/conexaoSmart.php';

//Salvando Regra Gestor
$insertGest = "INSERT INTO gestor_direto (
            id_empresa,
            id_departamento,
            login_smartshare,
            cpf_gestor,
            situacao
        ) VALUES (
            '".$_POST['empresa']."',
            '".$_POST['depto']."',
            '".$_POST['logins']."',
            '".$_POST['cpfDoador']."',
            '".$_POST['situacao']."'
        )";

$resultInsert = ociparse($conn, $insertGest);

if (ociexecute($resultInsert)) {
    header('location: ../front/smartshare_pag.php?id_drop=5&msn=1&id_usuario='. $_GET['id_usuario'] .''); //MSN - Regra adicionada com Sucesso!
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