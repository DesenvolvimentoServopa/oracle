<?php
session_start();
include('../config/conexaoSmartSelbetti.php');
include('../config/sqlSmart.php');

//localizando o usuário

$queryUserApi = " SELECT
        ds_usuario,
        ds_login,
        cd_usuario,
        ds_email
    FROM
        usuario
    WHERE
        st_ativo = 1
    AND cd_usuario NOT IN ( 1, 23, 24, 22, 16681,
                                18110, 18111, 18112, 18113, 18484,
                                18485, 18486, 18529, 18340, 16680,
                                18782)
    AND ds_usuario LIKE '".strtoupper($_POST['nomeGestor'])."%' OR ds_login LIKE '".strtolower($_POST['nomeGestor'])."%'";

$resultuser = ociparse($conns, $queryUserApi);
            ociexecute($resultuser);

while (($rowuser = oci_fetch_array($resultuser, OCI_BOTH)) != FAlSE) {
    $_SESSION['loginGestor'] = $rowuser['DS_LOGIN'];
    $_SESSION['usuarioGestor'] = $rowuser['DS_USUARIO'];
}

if($_SESSION['usuarioGestor'] == NULL){
    header('Location: smartshare_pag.php?id_drop='.$_GET['id_drop'].'&id_usuario='.$_GET['id_usuario'].'&buscar=0');
}else{
    header('Location: smartshare_pag.php?id_drop='.$_GET['id_drop'].'&id_usuario='.$_GET['id_usuario'].'&buscar=1');
}

