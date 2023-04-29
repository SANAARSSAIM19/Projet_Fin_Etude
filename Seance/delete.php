<?php include '../include/connexion.php'; 
$id= $_GET['id'];
$req = $db->prepare("delete from seance where ID_SEANCE=?");
$req->execute([$id]);
header('location: ../Seance/list.php?msg=deleted');

