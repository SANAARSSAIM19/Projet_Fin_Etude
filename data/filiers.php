<?php include '../include/connexion.php'; ?>
<?php

if(isset($_GET['dep'])){

    //weher depatrement=$_GET['dep']
    
    $req =  $db->query("select NOM_FILIERE_ ,ID_FILIERE_ from filiere where ID_DEPARTEMENT= ".$_GET['dep']);
    $req->execute();
    $res=$req->fetchAll();
    echo json_encode($res);
  
}

?>
                            
<?php

if(isset($_GET['grop'])){
    $req =  $db->query("select TYPE_GROUPE from groupe");
    $req->execute();
    $res=$req->fetchAll();
    $type= $res['TYPE_GROUPE'] ;

    //weher depatrement=$_GET['dep']
    
    $req =  $db->query("select NOM_GROUPE ,ID_GROUPE,TYPE_GROUPE from groupe where TYPE_GROUPE=$type and ID_GROUPE= ".$_GET['grop']  );
    $req->execute();
    $res=$req->fetchAll();
    echo json_encode($res);
  
}

?>

<?php
if(isset($_POST['submit'])){
    $NOM_GROUPE = $_POST['NOM_GROUPE'];
    $NOM_DEPARTEMENT = $_POST['NOM_DEPARTEMENT'];
    $NOM_FILIERE_ = $_POST['NOM_FILIERE_'];
    $NUM_SEMESTRE = $_POST['NUM_SEMESTRE'];
    $req =  $db->query("select CNE_ET,NOM_USER,PRENOM_USER,AVERTISEMENT_ET from etudiant  join affilier on etudiant.ID_ADMIN=affilier.ID_ADMIN 
    join groupe on affilier.ID_GROUPE=groupe.ID_GROUPE AND groupe.NOM_GROUPE=$NOM_GROUPE join filiere on groupe.ID_FILIERE_=filiere.ID_FILIERE_ AND filiere.NOM_FILIERE_=$NOM_FILIERE_
    join departement on filiere.ID_DEPARTEMENT=departement.ID_DEPARTEMENT AND departement.NOM_DEPARTEMENT=$NOM_DEPARTEMENT");
    $req->execute();
    $res=$req->fetchAll();
    echo json_encode($res);
}
?>