<?php include '../include/connexion.php'; 
$id= $_GET['id'];
$req = $db->prepare("delete from enseignant where ID_ADMIN=?");
$req->execute([$id]);
header('location: ../Enseignement/list.php?msg=deleted');

