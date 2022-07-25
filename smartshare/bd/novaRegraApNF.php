<?php

include '../config/conexaoSmart.php';

$verifRegra = "SELECT
                id_empresa,
                id_departamento
            FROM
                aprovadores_nf
            WHERE
                    id_empresa = '".$_POST['empresa']."'
            AND id_departamento = '".$_POST['depto']."'";

$resultVerif = ociparse($conn, $verifRegra);
ociexecute($resultVerif);

if (($rowverif = oci_fetch_array($resultVerif, OCI_BOTH)) != FALSE) {

    header('location: ../front/smartshare_pag.php?id_drop=9&msn=4&id_usuario='. $_GET['id_usuario'] .''); //Já existe uma empresa com esse departamento cadastrado!

}else{

    //salvando nova regra
    $inserirNovaRegraAp = "INSERT INTO aprovadores_nf (
        aprovador_filial,
        aprovador_area,
        aprovador_marca,
        aprovador_superintendente,
        id_empresa,
        id_departamento,
        aprovador_gerente,
        situacao
    ) VALUES (
        '".$_POST['filial'] ."',
        '".$_POST['area']."',
        '".$_POST['marca']."',
        '".$_POST['super']."',
        '".$_POST['empresa']."',
        '".$_POST['depto']."', 
        '".$_POST['gerente']."',
        '".$_POST['situacao']."')";

    $resultInsert = oci_parse($conn, $inserirNovaRegraAp);
    if (oci_execute($resultInsert)) {
        header('location: ../front/smartshare_pag.php?id_drop=9&msn=1&id_usuario='. $_GET['id_usuario'] .''); //msn 1 Salvo com sucesso!
    }else{
        $e = oci_error($resultdep);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
    }    
}

oci_close($conn);
?>