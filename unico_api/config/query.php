<?php

require_once('databases.php'); //banco de dados

$queryApollo = "SELECT NOME, CPF, ATIVO FROM GER_USUARIO";

$queryApolloVendedor = "SELECT NOME, CPF, ATIVO FROM FAT_VENDEDOR";

$queryNbs = "SELECT NOME, CPF, DEMITIDO FROM EMPRESAS_USUARIOS";

?>
