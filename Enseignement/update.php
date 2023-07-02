
<?php include '../include/connexion.php'; ?>


<?php
$message='';
if(isset($_POST['submit'])){
    $sql2="UPDATE enseignant  SET  
    NOM_USER = ?,PRENOM_USER = ?,DATEN_USER = ?
    ,CIN_USER = ?,EMAIL_USER = ?,PASSWORD_USER = ?,ADRESSE_USER = ?
    ,TELE_USER = ?,SEXE_USER = ?,TYPE_EN = ? WHERE Id_User = ?";
    $rs_modif = $db->prepare($sql2);
    $NOM_USER = $_POST['NOM_USER'];
    $PRENOM_USER = $_POST['PRENOM_USER'];
    $CIN_USER = $_POST['CIN_USER'];
    $DATEN_USER = $_POST['DATEN_USER'];
    $SEXE_USER = $_POST['SEXE_USER'];
    $EMAIL_USER = $_POST['EMAIL_USER'];
    $PASSWORD_USER = $_POST['PASSWORD_USER'];
    $ADRESSE_USER = $_POST['ADRESSE_USER'];
    $TELE_USER = $_POST['TELE_USER'];
    $TYPE_EN = $_POST['TYPE_EN'];
    $var_id    = $_POST['Id_User'];
    
    $rs_modif->bindValue(1,$NOM_USER,PDO::PARAM_STR);
    $rs_modif->bindValue(2,$PRENOM_USER,PDO::PARAM_STR);
    $rs_modif->bindValue(3,$DATEN_USER,PDO::PARAM_STR);
    $rs_modif->bindValue(4,$CIN_USER,PDO::PARAM_STR);
    $rs_modif->bindValue(5,$EMAIL_USER,PDO::PARAM_STR);
    $rs_modif->bindValue(6,$PASSWORD_USER,PDO::PARAM_STR);
    $rs_modif->bindValue(7,$ADRESSE_USER,PDO::PARAM_STR);
    $rs_modif->bindValue(8,$TELE_USER,PDO::PARAM_STR);
    $rs_modif->bindValue(9,$SEXE_USER,PDO::PARAM_STR);
    $rs_modif->bindValue(10,$TYPE_EN,PDO::PARAM_STR);
    $rs_modif->bindValue(11,$var_id,PDO::PARAM_INT);
    $rs_modif->execute();
    header('location: ../Enseignement/list.php?msg=updated');
    $message='   <div class="alert alert-success" role="alert">
    Enseignement modifier
  </div> ';
}

if(isset($_GET['id'])){
    
    $sql ="SELECT * FROM enseignant WHERE Id_User=? ";
    $rs_insert = $db->prepare($sql);
    $var_id=$_GET['id'];
    $rs_insert->bindValue(1,$var_id,PDO::PARAM_INT);
    $rs_insert->execute();
    $donnees = $rs_insert->fetch(PDO::FETCH_ASSOC);

    $NOM_USER=$donnees['NOM_USER'];
    $PRENOM_USER=$donnees['PRENOM_USER'];
    $DATEN_USER=$donnees['DATEN_USER'];
    $CIN_USER=$donnees['CIN_USER'];
    $EMAIL_USER=$donnees['EMAIL_USER'];
    $PASSWORD_USER=$donnees['PASSWORD_USER'];
    $ADRESSE_USER=$donnees['ADRESSE_USER'];
    $TELE_USER=$donnees['TELE_USER'];
    $SEXE_USER=$donnees['SEXE_USER'];
    $TYPE_EN=$donnees['TYPE_EN'];
}else{
  
    
    $NOM_USER='';
    $PRENOM_USER='';
    $DATEN_USER='';
    $CIN_USER='';
    $EMAIL_USER='';
    
    $PASSWORD_USER='';
    $ADRESSE_USER='';
    $TELE_USER='';
    $SEXE_USER='';
    $TYPE_EN='';
    
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
                  <input type="text"value="<?= $NOM_USER; ?>" class="form-control" placeholder="Nom" name="NOM_USER"id="NOM_USER">
                </div>
                <div class="col-md-6">
                  <input type="text" value="<?= $PRENOM_USER ?>"class="form-control" placeholder="Prenom"name="PRENOM_USER"id="PRENOM_USER">
                </div>
                <div class="col-md-6">
                  <input type="text" value="<?= $CIN_USER?>"class="form-control" placeholder="CIN"name="CIN_USER"id="CIN_USER">
                </div>
                
                <div class="col-md-6">
                  
                    <input type="date" class="form-control"value="<?= $DATEN_USER ?>"placeholder="Date Naissance"name="DATEN_USER"id="DATEN_USER">
                 
                </div>
                <div class="col-md-6">
                  
                  <input type="text" class="form-control"value="<?= $TYPE_EN ?>"placeholder="Type"name="TYPE_EN">
               
              </div>
                <div class="col-md-6">
                <select id="inputState"value="<?= $SEXE_USER ?>" class="form-select"name="SEXE_USER"id="SEXE_USER">
                    <option selected>Sexe</option>
                    <option>femme </option>
                    <option>Homme  </option>
                    <option>Autre  </option>
                  </select>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control"value="<?= $EMAIL_USER ?>" placeholder="Email"name="EMAIL_USER"id="EMAIL_USER">
                </div>
                <div class="col-md-6">
                  <input type="password" class="form-control"value="<?= $PASSWORD_USER ?>" placeholder="Password"name="PASSWORD_USER"id="PASSWORD_USER">
                </div>
                <div class="col-6">
                  <input type="text" class="form-control"value="<?= $ADRESSE_USER ?>" placeholder="Adresse "name="ADRESSE_USER"id="ADRESSE_USER">
                </div>
                
                
                <div class="col-md-6">
                  <input type="telephone" class="form-control"value="<?= $TELE_USER?>" placeholder="telephone"name="TELE_USER"id="TELE_USER">
                </div>
            
            
                <div class="text-center">
                <input type="hidden" name="Id_User" value="<?= $var_id; ?>">
                  <button type="submit" class="btn btn-primary"name="submit"value="modifier">Modifier</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End No Labels Form -->

            </div>
          </div>
          <?php include '../include/footer.php'; ?>