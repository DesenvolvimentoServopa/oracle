<?php

//AQUIVO LOCALIZADO NO 216

require_once('../config/sqlSmart.php');
require_once('../config/conexaoSmart.php');

$arraySmartshare = array();

$execSmart = oci_parse($conn, $emp);
oci_execute($execSmart);


while (($rowSmart = oci_fetch_assoc($execSmart)) != false) {
    $arraySmartshare['empresaSmart'][] = array(
        "ID_EMPRESA" => $rowSmart['ID_EMPRESA'],
        "NOME_EMPRESA" => $rowSmart['NOME_EMPRESA'],
        "SISTEMA" => $rowSmart['SISTEMA'],
        "UF_GESTAO" => $rowSmart['UF_GESTAO'],
        "CONSORCIO" => $rowSmart['CONSORCIO'],
        "APROVADOR_CAIXA" => $rowSmart['APROVADOR_CAIXA'],
        "NUMERO_CAIXA" => $rowSmart['NUMERO_CAIXA'],
        "FILIAL_SENIOR" => $rowSmart['FILIAL_SENIOR'],
        "EMPRESA_SENIOR" => $rowSmart['EMPRESA_SENIOR'],
        "ORGANOGRAMA_SENIOR" => $rowSmart['ORGANOGRAMA_SENIOR'],
        "EMPRESA_NBS" => $rowSmart['EMPRESA_NBS'],
        "REVENDA_APOLLO" => $rowSmart['REVENDA_APOLLO'],
        "EMPRESA_APOLLO" => $rowSmart['EMPRESA_APOLLO'],
        "SITUACAO" => $rowSmart['SITUACAO']
    );    
}

$apiSmart = json_encode($arraySmartshare);

oci_free_statement($execSmart);
oci_close($conn);

echo $apiSmart;
