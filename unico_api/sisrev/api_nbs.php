<?php

//AQUIVO LOCALIZADO NO 215 - BASE HOMOLOGAÇÃO

require_once('../config/query.php');

$arrayDadosNbs = array();

$execNbs = oci_parse($connNbs, $queryNbs);
oci_execute($execNbs);

while (($rowNbs = oci_fetch_assoc($execNbs)) != false) {
    $arrayDadosNbs['usuariosNbs'][] = array(
        "nome" => $rowNbs['NOME'],
        "cpf" => $rowNbs['CPF'],
        "demitido" => $rowNbs['DEMITIDO'],
        "sistema" => 'Nbs',
    );       
}

oci_free_statement($execNbs);
oci_close($connNbs);

$apiNbs = json_encode($arrayDadosNbs);

echo $apiNbs;

?>