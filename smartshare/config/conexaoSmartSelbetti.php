<?php
  $user = "#";
  $pass = "#";
  $dbstr = "(DESCRIPTION =

  (ADDRESS = (PROTOCOL = TCP)(HOST = #)(PORT = #))

  (CONNECT_DATA =

    (SERVER = DEDICATED)

    (SERVICE_NAME = #)

  )
)";

  $conns = oci_connect($user, $pass, $dbstr);

  if(!$conns){ 

      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

  }
?>