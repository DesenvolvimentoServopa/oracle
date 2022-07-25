<?php

include '../config/conexaoSmart.php';

include '../config/sqlSmart.php';

//Verificando se o departamento tem algum relacionamento em alguma outra tabela
$selectDep = "SELECT
                d.id_departamento  AS departamento,
                ed.id_departamento AS empresa_departamento,
                a.id_departamento  AS aprovadoresrh,
                g.id_departamento  AS gestordireto
            FROM
                departamento_nf      d
            LEFT JOIN empresa_departamento ed ON ( d.id_departamento = ed.id_departamento )
            LEFT JOIN aprovadores_rh       a ON ( d.id_departamento = a.id_departamento )
            LEFT JOIN gestor_direto        g ON ( d.id_departamento = g.id_departamento )
            WHERE
                    d.id_departamento = '".$_GET['id']."'
            AND ROWNUM = 1";

$resultDep = ociparse($conn, $selectDep);
ociexecute($resultDep);

if(($rowDep = oci_fetch_array($resultDep, OCI_BOTH)) != FALSE) { 

    if (($rowDep['EMPRESA_DEPARTAMENTO'] != NULL) || ($rowDep['APROVADORESRH'] != NULL) || ($rowDep['GESTORDIRETO'] != NULL)) {
        header('location: ../front/smartshare_pag.php?id_drop=10&msn=5&id_usuario='. $_GET['id_usuario'] .'');//msn=5 Departamento já possui relação em outra tabela
    }else{
    //Deletando Departamento

    $deleteDep = "DELETE FROM departamento_nf
                WHERE
                    id_departamento = '".$_GET['id']."'";

    $resultDelDep = oci_parse($conn, $deleteDep);
    oci_execute($resultDelDep);

    header('location: ../front/smartshare_pag.php?id_drop=10&msn=3&id_usuario='. $_GET['id_usuario'] .'');//msn=3 deletado com sucesso

    }
}

oci_close($conn)

?>