<?php

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

//Verificando se a regra já existe
$verifEmpDep = "SELECT
                *
                FROM
                empresa_departamento_nf
                WHERE
                    id_empresa = '".$_POST['empresa']."'
                AND id_departamento = '".$_POST['depto']."'";

$resultVerif = ociparse($conn, $verifEmpDep);
ociexecute($resultVerif);

if(($rowVerif = oci_fetch_array($resultVerif, OCI_BOTH)) != FALSE) {
    header('location: ../front/smartshare_pag.php?id_drop=11&msn=4&id_usuario='. $_GET['id_usuario'] .'');//Já existe uma regra adicionada com a empresa e o departamento
}else{

    //salvando nova regra
    $inserirNovaRegraEmpDep = "INSERT INTO empresa_departamento_nf (
        gerente_aprova,
        superintendente_aprova,
        id_empresa,
        id_departamento,
        situacao,
        lanca_multas
    ) VALUES (
        '".$_POST['gerap']."',
        '".$_POST['supap']."',
        '".$_POST['empresa']."',
        '".$_POST['depto']."',
        '".$_POST['situacao']."',
        '".$_POST['lancarMulta']."')";

    $resultInsert = oci_parse($conn, $inserirNovaRegraEmpDep);
    oci_execute($resultInsert);

    header('location: ../front/smartshare_pag.php?id_drop=11&msn=1&id_usuario='. $_GET['id_usuario'] .''); //msn 1 Salvo com sucesso!

}

oci_close($conn); 

?>