<?php
define("IDBNAME", 'tunse_interface_db');
define("IDBUSER", 'root');
define("IDBPASS", 'vagrant');

try {
  $iconn = new PDO('mysql:host=localhost; dbname='.IDBNAME, IDBUSER, IDBPASS);

  $iconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
 echo $e->getMessage();
}
