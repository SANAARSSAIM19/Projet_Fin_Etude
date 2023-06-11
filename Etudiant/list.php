



<?php include '../include/header1.php'; ?>



</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="get" action="../Etudiant/search.php">
    <input type="text" name="search" placeholder="Search" title="Enter search keyword" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" 
            class="form-control" 
                     >
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>

  

</div><!-- End Search Bar -->




<?php include '../include/header2.php'; ?>
<?php
 $message='';?>
<?php include '../include/connexion.php'; ?>

<div class="row g-3">
<div class="col-md-3">
<button type="button" class="btn btn-outline-primary"style="margin-top: 20px; "> <a class="nav-link " href="../Etudiant/add.php">Ajouter</a></button>
                </div>
                <div class="col-md-9">
                <form action="" method="post" enctype="multipart/form-data">
    <label for="excel_file">Sélectionnez un fichier Excel :</label>
    <input type="file" name="excel_file" id="excel_file">
    <input type="submit" value="Importer">
</form>              </div>
</div>
<?php

require '../myproject/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

include '../include/connexion.php';
// Vérification que le fichier Excel a bien été envoyé
if (isset($_FILES["excel_file"]) && $_FILES["excel_file"]["error"] == UPLOAD_ERR_OK) {
    // Lecture du fichier Excel
    $spreadsheet = IOFactory::load($_FILES["excel_file"]["tmp_name"]);
    $worksheet = $spreadsheet->getActiveSheet();

  
    // Boucle sur les lignes du fichier Excel
    foreach ($worksheet->getRowIterator() as $row) {
        $rowData = [];
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE);
  // Boucle sur les colonnes du fichier Excel
  foreach ($cellIterator as $cell) {
    $rowData[] = $cell->getValue();
}
        

        // Insertion des données dans la base de données
       // $sql = ('INSERT INTO etudiant (ADM_ID_USER,NOM_USER,PRENOM_USER,DATEN_USER,CIN_USER,EMAIL_USER,PASSWORD_USER,ADRESSE_USER,TELE_USER,SEXE_USER,CNE_ET,NOM_TUTEUR_ET,PRENOM_TUTEUR_ET,ADRESS_PARENTIELLE_ET,NIVEAU_ET,AVERTISEMENT_ET,NB_absence) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ');

       /* $stmt = $db->prepare($sql);
        $stmt->bindValue("sss", $rowData[0], $rowData[1], $rowData[2],$rowData[3],$rowData[4],$rowData[5],$rowData[6],$rowData[7],$rowData[8],$rowData[9],$rowData[10],$rowData[11],$rowData[12],$rowData[13],$rowData[14],$rowData[15],$rowData[16]);
        $stmt->execute($rowData);*/

        $stmt = $db->prepare('INSERT INTO etudiant (NOM_USER,PRENOM_USER,DATEN_USER,CIN_USER,EMAIL_USER,PASSWORD_USER,ADRESSE_USER,TELE_USER,SEXE_USER,CNE_ET,NOM_TUTEUR_ET,PRENOM_TUTEUR_ET,ADRESS_PARENTIELLE_ET,NIVEAU_ET,AVERTISEMENT_ET,NB_absence) values( :NOM_USER, :PRENOM_USER, :DATEN_USER, :CIN_USER, :EMAIL_USER, :PASSWORD_USER, :ADRESSE_USER, :TELE_USER, :SEXE_USER, :CNE_ET, :NOM_TUTEUR_ET, :PRENOM_TUTEUR_ET, :ADRESS_PARENTIELLE_ET, :NIVEAU_ET, :AVERTISEMENT_ET, :NB_absence )');
      $stmt->bindParam(':NOM_USER', $rowData[0]);
      $stmt->bindParam(':PRENOM_USER', $rowData[1]);
      $stmt->bindParam(':DATEN_USER', $rowData[2]);
      $stmt->bindParam(':CIN_USER', $rowData[3]);
      $stmt->bindParam(':EMAIL_USER', $rowData[4]);
      $stmt->bindParam(':PASSWORD_USER', $rowData[5]);
      $stmt->bindParam(':ADRESSE_USER', $rowData[6]);
      $stmt->bindParam(':TELE_USER', $rowData[7]);
      $stmt->bindParam(':SEXE_USER', $rowData[8]);
      $stmt->bindParam(':CNE_ET', $rowData[9]);
      $stmt->bindParam(':NOM_TUTEUR_ET', $rowData[10]);
      $stmt->bindParam(':PRENOM_TUTEUR_ET', $rowData[11]);
      $stmt->bindParam(':ADRESS_PARENTIELLE_ET', $rowData[12]);
      $stmt->bindParam(':NIVEAU_ET', $rowData[13]);
      $stmt->bindParam(':AVERTISEMENT_ET',$rowData[14]);
      $stmt->bindParam(':NB_absence', $rowData[15]);
    
      $stmt->execute($rowData);


    }
}

// Fermeture de la connexion à la base de données




















/*if (isset($_POST['submit'])) {
   // Récupérez le nom et le chemin du fichier téléchargé
   $fileName = $_FILES['file']['name'];
   $filePath = $_FILES['file']['tmp_name'];

   // Vérifiez que le fichier est un fichier Excel valide
   $fileType = IOFactory::identify($filePath);
   $allowedTypes = ['Xlsx', 'Xls', 'Ods'];
   if (!in_array($fileType, $allowedTypes)) {
      die('Le fichier doit être un fichier Excel valide.');
   }

   // Ouvrez le fichier Excel
   $spreadsheet = IOFactory::load($filePath);

   // Sélectionnez la feuille de calcul
   $worksheet = $spreadsheet->getActiveSheet();

   // Parcourez les lignes de la feuille de calcul
   foreach ($worksheet->getRowIterator() as $row) {
      // Récupérez les données de la ligne
      $rowData = [];
      foreach ($row->getCellIterator() as $cell) {
         $rowData[] = $cell->getValue();
      }

      // Insérez ces données dans la base de données
      include '../include/connexion.php';
     // $pdo = new PDO('mysql:host=127.0.0.1;dbname=pfe_absences;charset=utf8','root','7a6EQO');
     //$req = $db->prepare("insert into etudiant(CNE_ET,NOM_TUTEUR_ET,PRENOM_TUTEUR_ET,ADRESS_PARENTIELLE_ET,NIVEAU_ET,nom_user,DATEN_USER,CIN_USER,EMAIL_USER,prenom_user,PASSWORD_USER,ADRESSE_USER,TELE_USER,SEXE_USER) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

     $req = $db->prepare('INSERT INTO etudiant (ADM_ID_USER,NOM_USER,PRENOM_USER,DATEN_USER,CIN_USER,EMAIL_USER,PASSWORD_USER,ADRESSE_USER,TELE_USER,SEXE_USER,CNE_ET,NOM_TUTEUR_ET,PRENOM_TUTEUR_ET,ADRESS_PARENTIELLE_ET,NIVEAU_ET,AVERTISEMENT_ET,NB_absence) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ');
      // Remplacez les valeurs de ce code par les vôtres en fonction de votre base de données
     $req->execute();
   
     /* $stmt = $db->prepare('INSERT INTO etudiant (ADM_ID_USER,NOM_USER,PRENOM_USER,DATEN_USER,CIN_USER,EMAIL_USER,PASSWORD_USER,ADRESSE_USER,TELE_USER,SEXE_USER,CNE_ET,NOM_TUTEUR_ET,PRENOM_TUTEUR_ET,ADRESS_PARENTIELLE_ET,NIVEAU_ET,AVERTISEMENT_ET,NB_absence) values( :ADM_ID_USER, :NOM_USER, :PRENOM_USER, :DATEN_USER, :CIN_USER, :EMAIL_USER, :PASSWORD_USER, :ADRESSE_USER, :TELE_USER, :SEXE_USER, :CNE_ET, :NOM_TUTEUR_ET, :PRENOM_TUTEUR_ET, :ADRESS_PARENTIELLE_ET, :NIVEAU_ET, :AVERTISEMENT_ET, :NB_absence )');
      $stmt->bindParam(':ADM_ID_USER', $ADM_ID_USER);
      $stmt->bindParam(':NOM_USER', $NOM_USER);
      $stmt->bindParam(':PRENOM_USER', $PRENOM_USER);
      $stmt->bindParam(':DATEN_USER', $DATEN_USER);
      $stmt->bindParam(':CIN_USER', $CIN_USER);
      $stmt->bindParam(':EMAIL_USER', $EMAIL_USER);
      $stmt->bindParam(':PASSWORD_USER', $PASSWORD_USER);
      $stmt->bindParam(':ADRESSE_USER', $ADRESSE_USER);
      $stmt->bindParam(':TELE_USER', $TELE_USER);
      $stmt->bindParam(':SEXE_USER', $SEXE_USER);
      $stmt->bindParam(':CNE_ET', $CNE_ET);
      $stmt->bindParam(':NOM_TUTEUR_ET', $NOM_TUTEUR_ET);
      $stmt->bindParam(':PRENOM_TUTEUR_ET', $PRENOM_TUTEUR_ET);
      $stmt->bindParam(':ADRESS_PARENTIELLE_ET', $ADRESS_PARENTIELLE_ET);
      $stmt->bindParam(':NIVEAU_ET', $NIVEAU_ET);
      $stmt->bindParam(':AVERTISEMENT_ET', $AVERTISEMENT_ET);
      $stmt->bindParam(':NB_absence', $NB_absence);
    
      $stmt->execute();


   }



   // Fermez le fichier Excel
   $spreadsheet->disconnectWorksheets();
}
*/
?>








<div class="col-md-8 mx-auto">
            <?php if(isset($_GET['msg']) && $_GET['msg']=='added'):  ?>
                <div class="alert alert-success">Ajouter avec succes
                    <span data-dismiss="alert" class="close">&times;</span>
                </div>
            <?php endif; ?>
            <?php if(isset($_GET['msg']) && $_GET['msg']=='updated'):  ?>
                <div class="alert alert-warning">Modifier avec succes
                    <span data-dismiss="alert" class="close">&times;</span>
                </div>
            <?php endif; ?>
            <?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'):  ?>
                <div class="alert alert-danger">Modifier avec succes
                    <span data-dismiss="alert" class="close">&times;</span>
                </div>
            <?php endif; ?>
        </div>

<div class="table-responsive"style="margin-top: 70px; ">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="table-primary">
                                   
                                    <th scope="col">CIN</th>
                                    <th scope="col">CNE</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Date Naissance</th>
                                    <th scope="col">Sexe</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Adresse parentielle</th>
                                    <th scope="col">telephone</th>
                                    <th scope="col">Niveau</th>
                                    <th scope="col">filiere</th>
                                    
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                       $req =  $db->query("SELECT etudiant.CIN_USER,etudiant.ID_ADMIN, etudiant.CNE_ET, etudiant.NOM_USER, etudiant.PRENOM_USER, etudiant.DATEN_USER,
                       etudiant.SEXE_USER ,etudiant.EMAIL_USER ,etudiant.PASSWORD_USER ,etudiant.ADRESSE_USER ,etudiant.ADRESS_PARENTIELLE_ET ,etudiant.TELE_USER ,etudiant.NIVEAU_ET ,filiere.ID_FILIERE_ AS ID_FILIERE_
                       ,filiere.NOM_FILIERE_ AS NOM_FILIERE_ FROM etudiant
JOIN filiere ON etudiant.ID_FILIERE_ = filiere.ID_FILIERE_;");

                       
                       while($data = $req->fetch()):
                              ?>

                              

                                <tr>
                                    <td><?= $data['CIN_USER'] ?></td>
                                    <td><?= $data['CNE_ET'] ?></td>
                                    <td><?= $data['NOM_USER'] ?></td>
                                    <td><?= $data['PRENOM_USER'] ?></td>
                                    <td><?= $data['DATEN_USER'] ?></td>
                                    <td><?= $data['SEXE_USER'] ?></td>
                                    <td><?= $data['EMAIL_USER'] ?></td>
                                    <td><?= $data['PASSWORD_USER'] ?></td>
                                    <td><?= $data['ADRESSE_USER'] ?></td>
                                    <td><?= $data['ADRESS_PARENTIELLE_ET'] ?></td>
                                    <td><?= $data['TELE_USER'] ?></td>
                                    <td><?= $data['NIVEAU_ET'] ?></td>
                                    <td><?= $data['NOM_FILIERE_'] ?></td>
                                  
                                    <td><a class="btn btn-sm btn-success" href="../Etudiant/update.php?id=<?= $data['ID_ADMIN'] ?>"><i class="bi bi-pencil-square"></i></a>
                                  <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="btn btn-sm btn-danger"   href="../Etudiant/delete.php?id=<?= $data['ID_ADMIN'] ?>"><i class="bi bi-trash3"></i></a>  </td>
                                  </tr>
                   <?php endwhile; ?>
     
                                
                               
                              
                            </tbody>
                        </table>
                    </div>

















                    


<?php include '../include/footer.php'; ?>

