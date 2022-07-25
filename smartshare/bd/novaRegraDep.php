<?php

//chamar o banco

include '../config/conexaoSmart.php';

// ajustar as variaveis

function sanitizeString($str) {
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    return $str;
}

$espace = trim($_POST['nomedpto']);

$car = sanitizeString($espace);

$updpto = strtoupper($car);

//verificar se ja existe
$verdpto = "SELECT nome_departamento FROM departamento_rh WHERE NOME_DEPARTAMENTO = '".$updpto."'";

$resultrh = ociparse($conn, $verdpto);
ociexecute($resultrh);

if (($rowdpto = oci_fetch_array($resultrh, OCI_BOTH)) != FALSE) {

    header('location: ../front/smartshare_pag.php?id_drop=2&msn=4&id_usuario='. $_GET['id_usuario'] .''); //msn dpto inserido com sucesso

//salvar o departamento
}else{    
    $insertDpto = "INSERT INTO departamento_rh (
        nome_departamento,
        situacao
    ) VALUES (
        '".$updpto."',
        '".$_POST['situacao']."'
    )";

    $resultInsert = ociparse($conn, $insertDpto);
    
    if(ociexecute($resultInsert)){
        header('location: ../front/smartshare_pag.php?id_drop=2&msn=1&id_usuario='. $_GET['id_usuario'] .''); //msn dpto inserido com sucesso
    }else{
        $e = oci_error($resultInsert);
        print htmlentities($e['message']);
        print "\n<pre>\n";
        print htmlentities($e['sqltext']);
        printf("\n%".($e['offset']+1)."s", "^");
        print  "\n</pre>\n";
    }
}

oci_close($conn);

?>