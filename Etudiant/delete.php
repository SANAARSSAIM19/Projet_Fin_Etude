<?php include '../include/connexion.php'; 
$id= $_GET['id'];
$req = $db->prepare("delete from etudiant where ID_ADMIN=?");
$req->execute([$id]);
header('location: ../Etudiant/list.php?msg=deleted');

