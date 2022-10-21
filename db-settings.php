<?php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'HQDevice';
  
  
  $connection = $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);

if ($mysqli->connect_error) {
    die('Goodbye, database is not right');
}
?>