<?php

/*BANCO PRODUCAO*/

  $user = "###";
  $pass = "###";
  $dbstr = "(DESCRIPTION =

  (ADDRESS = (PROTOCOL = TCP)(HOST = ##.###.#.###)(PORT = ####))

    (CONNECT_DATA =

      (SERVER = DEDICATED)

      (SERVICE_NAME = ####)

    )

  )";

  $conn = oci_connect($user, $pass, $dbstr);

  if(!$conn){ 
      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  }else{
    /* echo "Conexão realizada com sucesso!"; */
  }
?>