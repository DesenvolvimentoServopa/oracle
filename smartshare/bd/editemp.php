<?php

require_once('../config/conexaoSmart.php');

//Editando Regra Empresa
$info = $_GET['id_empresa'];
$valueApollo = ($_POST['empApollo'] == NULL) ? '0' : $_POST['empApollo'];
$valueRevApollo = ($_POST['revApollo'] == NULL) ? '0' : $_POST['revApollo'];
$valueEmpNbs = ($_POST['empnbs'] == NULL) ? '0' : $_POST['empnbs'];

$updateRegraEmp ="UPDATE empresa
            SET
                sistema = '".$_POST['sistema']."',
                empresa_apollo = '".$valueApollo."',
                revenda_apollo = '".$valueRevApollo."',
                empresa_nbs = '".$valueEmpNbs."',                
                organograma_senior = '".$_POST['orgsenior']."',
                empresa_senior = '".$_POST['empresasenior']."',
                filial_senior = '".$_POST['filialsenior']."',
                consorcio ='".$_POST['consorcio']."',
                situacao ='".$_POST['situacao']."',
                numero_caixa ='".$_POST['numero_caixa']."',
                aprovador_caixa ='".$_POST['aproCaixa']."',
                uf_gestao = '".$_POST['estado']."'
            WHERE
                id_empresa = '".$_GET['id_empresa']."'";

$resultUpdateEmp = oci_parse($conn, $updateRegraEmp);
oci_execute($resultUpdateEmp);

oci_free_statement($resultUpdateEmp);
oci_close($conn);

header('location: http://10.100.1.214/unico/sistemas/sisrev/front/empresas.php?pg='.$_GET['pg'].'&msn=4');//msn=4 editado com sucesso