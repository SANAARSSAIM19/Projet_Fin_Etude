<?php

try{
    $db = new PDO('mysql:host=127.0.0.1;dbname=pfe_absences;charset=utf8','root','7a6EQO');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}catch(Exception $e){
    die('msssssg :: '.$e->getMessage());
} 
?>
<?php
 $message='';
if(isset($_POST['submit'])){
    $NOM_USER = $_POST['NOM_USER'];
    $PRENOM_USER = $_POST['PRENOM_USER'];
    $DATEN_USER = $_POST['DATEN_USER'];
    $CIN_USER = $_POST['CIN_USER'];
    $EMAIL_USER = $_POST['EMAIL_USER'];
    $PASSWORD_USER = $_POST['PASSWORD_USER'];
    $ADRESSE_USER = $_POST['ADRESSE_USER'];
    $TELE_USER = $_POST['TELE_USER'];
    $SEXE_USER = $_POST['SEXE_USER'];
    $TYPE_EN = $_POST['TYPE_EN'];
    $ID_ADMIN = $_POST['ID_ADMIN'];
   
    if(empty($DATEN_USER) || !strtotime($DATEN_USER)){
      $message = "La date de naissance est invalide";
  } else {
    $req = $db->prepare("insert into enseignant(ID_ADMIN,NOM_USER,PRENOM_USER,DATEN_USER,CIN_USER,EMAIL_USER,PASSWORD_USER,ADRESSE_USER,TELE_USER,SEXE_USER,TYPE_EN) values(?,?,?,?,?,?,?,?,?,?,?)");
    $req->execute([$ID_ADMIN,$NOM_USER,$PRENOM_USER,$DATEN_USER,$CIN_USER,$EMAIL_USER,$PASSWORD_USER,$ADRESSE_USER,$TELE_USER,$SEXE_USER,$TYPE_EN]);
    header('location: ../Enseignement/list.php?msg=added');
exit;
  }}


?>


<?php require_once '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php require_once '../include/header2.php'; ?>
<?= $message ;?>

<div class="card">
            <div class="card-body">
              <h5 class="card-title">Ajouter les Information de Enseignement</h5>


        
              <!-- No Labels Form -->
              <form class="row g-3"method="post">
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Nom" name="NOM_USER">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Prenom"name="PRENOM_USER">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="CIN"name="CIN_USER">
                </div>
                
                <div class="col-md-6">
                  
                    <input type="date" class="form-control"placeholder="Date Naissance"name="DATEN_USER">
                 
                </div>
                <div class="col-md-6">
                  
                  <input type="text" class="form-control"placeholder="Type"name="TYPE_EN">
               
              </div>
                <div class="col-md-6">
                <select id="inputState" class="form-select"name="SEXE_USER">
                    <option selected>Sexe</option>
                    <option>femme </option>
                    <option>Homme  </option>
                    <option>Autre  </option>
                  </select>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" placeholder="Email"name="EMAIL_USER">
                </div>
                <div class="col-md-6">
                  <input type="password" class="form-control" placeholder="Password"name="PASSWORD_USER">
                </div>
                <div class="col-6">
                  <input type="text" class="form-control" placeholder="Adresse "name="ADRESSE_USER">
                </div>
             
                
                <div class="col-md-6">
                  <input type="telephone" class="form-control" placeholder="telephone"name="TELE_USER">
                </div>
               
               
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"name="submit" value="submit">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End No Labels Form -->

            </div>
          </div>
          <?php include '../include/footer.php'; ?>