<?php
try{
    $db = new PDO('mysql:host=127.0.0.1;dbname=pfe_absences;charset=utf8','root','7a6EQO');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}catch(Exception $e){
    die('msssssg :: '.$e->getMessage());
}

?>
<?php


