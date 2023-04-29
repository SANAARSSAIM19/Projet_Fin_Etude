
<?php include '../include/connexion.php'; ?>

<?php
function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    // Set bits 6-7 to 10

    // Output the 36 character UUID.
    return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
}

$sql = 'select * from enseignant';
$rs_insert = $db->prepare($sql);
$rs_insert->execute();
$enseignant = $rs_insert->fetchAll();
  $sql = 'select * from element';
$rs_insert = $db->prepare($sql);
$rs_insert->execute();
$element = $rs_insert->fetchAll();
  $num_tiket = guidv4();
  $sql = 'select * from groupe';
$rs_insert = $db->prepare($sql);
$rs_insert->execute();
$groupe = $rs_insert->fetchAll();
  $num_tiket = guidv4();
?>
<?php
$message='';
if(isset($_POST['submit'])){
    $sql2="UPDATE seance  SET  ID_ELEMENT = ?,ID_GROUPE = ?,ID_ADMIN = ?
    ,HEURED_SEANCE = ?,HEUREF_SEANCE = ?,NUM_SALLE = ? WHERE ID_SEANCE = ?";
    $rs_modif = $db->prepare($sql2);
    $ID_ELEMENT = $_POST['ID_ELEMENT'];
    $ID_GROUPE = $_POST['ID_GROUPE'];
    $ID_ADMIN = $_POST['ID_ADMIN'];
    $HEURED_SEANCE = $_POST['HEURED_SEANCE'];
    $HEUREF_SEANCE = $_POST['HEUREF_SEANCE'];
    $NUM_SALLE = $_POST['NUM_SALLE'];
    $var_id    = $_POST['ID_SEANCE']; 
    $rs_modif->bindValue(1,$ID_ELEMENT,PDO::PARAM_INT);
    $rs_modif->bindValue(2,$ID_GROUPE,PDO::PARAM_INT);
    $rs_modif->bindValue(3,$ID_ADMIN,PDO::PARAM_INT);
    $rs_modif->bindValue(4,$HEURED_SEANCE,PDO::PARAM_STR);
    $rs_modif->bindValue(5,$HEUREF_SEANCE,PDO::PARAM_STR);
    $rs_modif->bindValue(6,$NUM_SALLE,PDO::PARAM_INT);
    $rs_modif->bindValue(7,$var_id,PDO::PARAM_INT);
    $rs_modif->execute();
    header('location: ../Seance/list.php?msg=updated');
    $message='   <div class="alert alert-success" role="alert">
    produit modifier
  </div> ';
}

if(isset($_GET['id'])){
    
    $sql ="SELECT * FROM seance WHERE ID_SEANCE=? ";
    $rs_insert = $db->prepare($sql);
    $var_id=$_GET['id'];
    $rs_insert->bindValue(1,$var_id,PDO::PARAM_INT);
    $rs_insert->execute();
    $donnees = $rs_insert->fetch(PDO::FETCH_ASSOC);
    $ID_ELEMENT = $donnees['ID_ELEMENT'];
    $ID_GROUPE = $donnees['ID_GROUPE'];
    $ID_ADMIN = $donnees['ID_ADMIN'];

    $HEURED_SEANCE = $donnees['HEURED_SEANCE'];
    $HEUREF_SEANCE = $donnees['HEUREF_SEANCE'];
    $NUM_SALLE = $donnees['NUM_SALLE'];
}else{
  $ID_ELEMENT='';
  $ID_GROUPE='';
  $ID_ADMIN='';
  $HEURED_SEANCE='';
    $HEUREF_SEANCE='';
    $NUM_SALLE='';
    
}

?>


<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php include '../include/header2.php'; ?>

<?= $message ;?> 
<div class="card">
            <div class="card-body">
              <h5 class="card-title">Modifier les Information de L'Enseignement</h5>

              <!-- No Labels Form -->
              <form class="row g-3"method="post">
              
                <div class="col-md-6">
                <label for="appt">Heure Debut:</label>
                  <input type="time" value="<?= $HEURED_SEANCE; ?>" class="form-control" name="HEURED_SEANCE" id="HEURED_SEANCE">
                </div>
                <div class="col-md-6">
                <label for="appt">Heure Fin:</label>
                  <input type="time" value="<?= $HEUREF_SEANCE; ?>" class="form-control" name="HEUREF_SEANCE"id="HEUREF_SEANCE">
                </div>
                <div class="col-12">
                  <input type="Number"value="<?= $NUM_SALLE; ?>" class="form-control" placeholder="Numero de Salle"name="NUM_SALLE"id="NUM_SALLE">
                </div>
                
                <div class="col-md-12">
                 

                  <select class="form-select"value="<?= $ID_ADMIN; ?>" name='ID_ADMIN' aria-label="Default select example">
                  <option selected>Nom Ensienement</option>
									<?php
									    foreach($enseignant as $enseignante){
                                            $id = $enseignante['ID_ADMIN'];
											echo "<option value='".$id."' >".$enseignante['NOM_USER']."</option>";
										}
									?>
									</select>  

                </div>
          
                <div class="col-md-6">
                  <select id="inputState"value="<?= $ID_ELEMENT; ?>" class="form-select"name="ID_ELEMENT">
                    <option selected>Element</option>
                    <?php
									    foreach($element as $elemente){
                                            $id = $elemente['ID_ELEMENT'];
											echo "<option value='".$id."' >".$elemente['NOM_ELEMENT']."</option>";
										}
									?>
                  </select>
                </div>
                <div class="col-md-6">
                  <select id="inputState"value="<?= $ID_GROUPE; ?>" class="form-select"name="ID_GROUPE">
                    <option selected>Groupe</option>
                    <?php
									    foreach($groupe as $group){
                                            $id = $group['ID_GROUPE'];
											echo "<option value='".$id."' >".$group['NOM_GROUPE']."</option>";
										}
									?>
                  </select>
                </div>
                <div class="text-center">
                <input type="hidden" name="ID_SEANCE" value="<?= $var_id; ?>">
                  <button type="submit" class="btn btn-primary"name="submit"value="modifier">Modifier</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End No Labels Form -->

            </div>
          </div>
          <?php include '../include/footer.php'; ?>