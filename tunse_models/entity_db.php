<?php

define("DBNAME", 'tunse_entity_db');
define("DBUSER", 'root');
define("DBPASS", 'dre');

try {
  $econn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

  $econn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 echo $e->getMessage();
}
