<?php include '../include/connexion.php'; 
$id= $_GET['id'];
$req = $db->prepare("delete from enseignant where Id_User=?");
$req->execute([$id]);
header('location: ../Enseignement/list.php');

