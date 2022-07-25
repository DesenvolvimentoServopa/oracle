<?php

//AQUIVO LOCALIZADO NO 216

require_once('../config/sqlSmart.php');
require_once('../config/conexaoSmartSelbetti.php');

//UserAPI

$arrayUser = array();

$execSmartUser = oci_parse($conns, $query_user);
oci_execute($execSmartUser);

while (($rowUser = oci_fetch_assoc($execSmartUser)) != false) {
    $arrayUser['Users'][] = array(
        "USERS" => $rowUser['DS_USUARIO'],
        "LOGIN" => $rowUser['DS_LOGIN'],
        "CODUSER" => $rowUser['CD_USUARIO'],
        "EMAIL" => $rowUser['DS_EMAIL'],
        "SITUACAO" => $rowUser['ST_ATIVO'],
        "SITUACAO" => $rowUser['SITUACAO']
    );       
}

$apiUser = json_encode($arrayUser);

echo $apiUser;

?>
