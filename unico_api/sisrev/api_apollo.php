<?php

//AQUIVO LOCALIZADO NO 215 - BASE HOMOLOGAÇÃO

require_once('../config/query.php');

$arrayDadosApollo = array();

$execApollo = oci_parse($connApollo, $queryApollo);//$queryApollo GER_USUARIO
oci_execute($execApollo);

while (($rowApollo = oci_fetch_assoc($execApollo)) != false) {
    $arrayDadosApollo['usuariosApollo'][] = array(
        "nome" => $rowApollo['NOME'],
        "cpf" => $rowApollo['CPF'],
        "ativo" => $rowApollo['ATIVO'],
        "sistema" => 'Apollo',
    );     
}

oci_free_statement($connApollo);
oci_close($connApollo);

$execApolloVendedor = oci_parse($connApollo, $queryApolloVendedor);//$queryApolloVendedor FAT_VENDEDOR
oci_execute($execApolloVendedor);

while (($rowApolloVendedor = oci_fetch_assoc($execApolloVendedor)) != false) {
    $arrayDadosApollo['usuariosApollo'][] = array(
        "nome" => $rowApolloVendedor['NOME'],
        "cpf" => $rowApolloVendedor['CPF'],
        "ativo" => $rowApolloVendedor['ATIVO'],
        "sistema" => 'Apollo',
    );    
}

oci_free_statement($connApollo);
oci_close($connApollo);

$apiApollo = json_encode($arrayDadosApollo);

echo $apiApollo;

?>