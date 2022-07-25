<?php

require_once('../config/conexaoSmart.php');

$delete = "DELETE FROM MFP_WEB WHERE ID_LINK = ".$_GET['id_link'];
$result = oci_parse($conn, $delete);
oci_execute($result);

oci_close($conn);

header('Location: ../front/smartshare_pag.php?id_drop=13&id_usuario='.$_GET['id_usuario'].'&msn=3');
?>