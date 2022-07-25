<?php

//chamando o banco
include '../config/conexaoSmart.php';

//Verificando se já exite uma regra com a mesma empresa e aprovador_gestor selecionados
$verifRegra = "SELECT
                id_empresa
            FROM
                aprovadores_rh
            WHERE
                id_empresa = '".$_POST['empresa']."'";

$resultVerifRegra = ociparse($conn, $verifRegra);
ociexecute($resultVerifRegra);

if (($rowverif = oci_fetch_array($resultVerifRegra, OCI_BOTH)) != FALSE) {
    //Já existe uma empresa
    header('location: ../front/smartshare_pag.php?id_drop=6&msn=4&id_usuario='. $_GET['id_usuario'] .''); 
}else{

    //salvando nova regra
    $inserirNovaRegraAprovFilial = " INSERT INTO aprovadores_rh (
                                    id_empresa,
                                    aprovador_gestor,
                                    situacao,
                                    tipo_registro
                                ) VALUES (
                                    '".$_POST['empresa']."',
                                    '".$_POST['logins']."',
                                    '".$_POST['situacao']."',
                                    'G'
                                    )";
    
    $resultInsert = oci_parse($conn, $inserirNovaRegraAprovFilial);

    if(oci_execute($resultInsert)){
        //msn 1 Salvo com sucesso!
        header('location: ../front/smartshare_pag.php?id_drop=6&msn=1&id_usuario='. $_GET['id_usuario'] .''); //msn 1 Salvo com sucesso!
    }else{  
        //Verificando erros      
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