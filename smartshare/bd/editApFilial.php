<?php

//chamando o banco
include '../config/conexaoSmart.php';

//Verificando se já exite uma regra com a mesma empresa e aprovador_gestor selecionados
$verifRegra = "SELECT
                id_empresa,
                aprovador_gestor,
                situacao
            FROM
                aprovadores_rh
            WHERE
                id_aprovador = '".$_GET['id']."'";


$resultVerifRegra = ociparse($conn, $verifRegra);
ociexecute($resultVerifRegra);

if (($rowverif = oci_fetch_array($resultVerifRegra, OCI_BOTH)) != FALSE) {

    if(($rowverif['ID_EMPRESA'] == $_POST['empresa']) && ($rowverif['APROVADOR_GESTOR'] == $_POST['logins']) && ($rowverif['SITUACAO'] == $_POST['situacao'])){
        header('Location: ../front/editApFilial.php?id='.$_GET['id'].'&id_usuario='. $_GET['id_usuario'] .'');
    }else{

        $veriIDaprovador = "SELECT
            id_aprovador
        FROM
            aprovadores_rh
        WHERE
            aprovador_gestor = '".$_POST['logins']."' AND id_empresa = '".$_POST['empresa']."'";

        $resultIDaprovador = ociparse($conn, $veriIDaprovador);
        ociexecute($resultIDaprovador); 

        if (($idAprovador = oci_fetch_array($resultIDaprovador, OCI_BOTH)) != FALSE) {

           if($idAprovador['ID_APROVADOR'] == $_GET['id']){

                $updateSituacao = "UPDATE aprovadores_rh SET situacao = '".$_POST['situacao']."' WHERE id_aprovador = ".$_GET['id']."";
                $resultUpdateSituacao = ociparse($conn, $updateSituacao);

                if(oci_execute($resultUpdateSituacao)){
                    //msn 1 Salvo com sucesso!
                    header('location: ../front/smartshare_pag.php?id_drop=6&msn=2&id_usuario='. $_GET['id_usuario'] .''); //msn 2 Salvo com sucesso!
                }else{  
                    //Verificando erros      
                    $e = oci_error($resultInsert);
                    print htmlentities($e['message']);
                    print "\n<pre>\n";
                    print htmlentities($e['sqltext']);
                    printf("\n%".($e['offset']+1)."s", "^");
                    print  "\n</pre>\n";
                } 
            }else{
                header('location: ../front/smartshare_pag.php?id_drop=6&msn=4&id_usuario='. $_GET['id_usuario'] .''); //msn 2 Salvo com sucesso!
            }

        }else{
            //Fazendo upt na tabela com o gestor e situacao
            $updateGestSit = "UPDATE aprovadores_rh SET aprovador_gestor = '".$_POST['logins']."', situacao = '".$_POST['situacao']."' WHERE id_aprovador = ".$_GET['id']."";

            $resultUpdateGestSit = ociparse($conn, $updateGestSit);

            if(oci_execute($resultUpdateGestSit)){
                //msn 2 Salvo com sucesso!
                header('location: ../front/smartshare_pag.php?id_drop=6&msn=2&id_usuario='. $_GET['id_usuario'] .''); //msn 2 Salvo com sucesso!
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

    }

}

oci_close($conn);

?>