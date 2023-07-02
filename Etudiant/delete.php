<?php include '../include/connexion.php'; 
$id= $_GET['id'];
$req = $db->prepare("delete from etudiant where Id_User=?");
$req->execute([$id]);
header('location: ../Etudiant/list.php?msg=deleted');

