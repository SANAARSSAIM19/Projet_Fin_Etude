

<?php include '../include/connexion.php'; ?>
<?php
 $message='';
if(isset($_POST['submit'])){
    $nom_user = $_POST['nom_user'];
    $prenom_user = $_POST['prenom_user'];
    $CIN_USER = $_POST['CIN_USER'];
    $CNE_ET = $_POST['CNE_ET'];
    $DATEN_USER = $_POST['DATEN_USER'];
    $SEXE_USER = $_POST['SEXE_USER'];
    $EMAIL_USER = $_POST['EMAIL_USER'];
    $PASSWORD_USER = $_POST['PASSWORD_USER'];
    $ADRESSE_USER = $_POST['ADRESSE_USER'];
    $ADRESS_PARENTIELLE_ET = $_POST['ADRESS_PARENTIELLE_ET'];
    $TELE_USER = $_POST['TELE_USER'];
    $NIVEAU_ET = $_POST['NIVEAU_ET'];
    $ID_FILIERE_ = $_POST['ID_FILIERE_'];
  
    $NB_absence=0;

    $req = $db->prepare("insert into etudiant(ID_FILIERE_,NOM_USER,PRENOM_USER,DATEN_USER,CIN_USER,EMAIL_USER,PASSWORD_USER,ADRESSE_USER,TELE_USER,SEXE_USER,CNE_ET,ADRESS_PARENTIELLE_ET,NIVEAU_ET,NB_absence) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $req->execute([$ID_FILIERE_,$nom_user,$prenom_user,$DATEN_USER,$CIN_USER,$EMAIL_USER,$PASSWORD_USER,$ADRESSE_USER,$TELE_USER,$SEXE_USER,$CNE_ET,$ADRESS_PARENTIELLE_ET,$NIVEAU_ET,$NB_absence]);
   
    header('location: ../Etudiant/list.php?msg=added');
    exit;
    
    


}
?>


<?php require_once '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php require_once '../include/header2.php'; ?>
<?= $message ;?>

<div class="card">
            <div class="card-body">
              <h5 class="card-title">Ajouter les Information de L'etudiant</h5>

              <!-- No Labels Form -->
              <form class="row g-3"method="post">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Nom" name="nom_user">
                </div>
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Prenom"name="prenom_user">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="CIN"name="CIN_USER">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="CNE"name="CNE_ET">
                </div>
                <div class="col-md-6">
                  
                    <input type="date" class="form-control"placeholder="Date Naissance"name="DATEN_USER">
                 
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
                <div class="col-12">
                  <input type="text" class="form-control" placeholder="Adresse "name="ADRESSE_USER">
                </div>
                <div class="col-12">
                  <input type="text" class="form-control" placeholder="Adresse Parentielle"name="ADRESS_PARENTIELLE_ET">
                </div>
                
                <div class="col-md-4">
                  <input type="telephone" class="form-control" placeholder="telephone"name="TELE_USER">
                </div>
                <div class="col-md-4">
                  <select id="inputState" class="form-select"name="NIVEAU_ET">
                    <option selected>Niveau</option>
                    <option>1 Annee  </option>
                    <option>2 Annee  </option>
                    <option>LP  </option>
                  </select>
                </div>
                <div class="col-md-4">
                
    <select name="ID_FILIERE_" id="ID_FILIERE_"class="form-select"  required>
    <option value="">filiere</option>
    <?php
    $selectFilieres = $db->query("SELECT ID_FILIERE_ , NOM_FILIERE_ FROM  filiere ");
    // Récupérer les résultats de la requête dans un tableau
    $filieres = $selectFilieres->fetchAll(PDO::FETCH_ASSOC);
    foreach($filieres as $filiere): ?>

      <option value="<?php echo $filiere['ID_FILIERE_']; ?>"><?php echo $filiere['NOM_FILIERE_']; ?></option>
        <?php endforeach; ?>
    </select>
    </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"name="submit">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End No Labels Form -->

            </div>
          </div>
          <?php include '../include/footer.php'; ?>