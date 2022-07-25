<?php

include '../config/conexaoSmart.php';
include '../config/sqlSmart.php';

//Editando Regra

$ger = ($_POST['gerente'] == NULL) ? '' :  $ger = $_POST['gerente'];

$updateRegra = "UPDATE aprovadores_rh
            SET
                aprovador_area = '".$_POST['area']."',
                aprovador_filial = '".$_POST['filial']."',                
                aprovador_marca = '".$_POST['marca']."',
                aprovador_gerente = '".$ger."',
                aprovador_superintendente = '".$_POST['super']."',
                situacao = '".$_POST['situacao']."'
            WHERE
                id_aprovador = '".$_GET['id_aprovador']."'";

$resultUpdate = oci_parse($conn, $updateRegra);

if (oci_execute($resultUpdate)) {
    header('location: ../front/smartshare_pag.php?id_drop=4&msn=2&id_usuario='. $_GET['id_usuario'] .'');//msn=2 editado com sucesso
}else{
    $e = oci_error($resultdep);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($conn)

?>
