

<?php  require_once '../PHPExcel/Classes/PHPExcel.php' ?>
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
<button type="button" class="btn btn-outline-primary"style="margin-top: 20px; "> <a class="nav-link " href="../Enseignement/add.php">Ajouter</a></button>
                </div>
                <!-- <div class="col-md-9">
                <form>
<div class="mb-3">
  <label class="text-primary"for="formFile" class="form-label"style="margin-left: 300px; "style="margin-top: 30px; ">Ajouter un Group Enseignement</label><br>
  <input class="btn btn-outline-primary"style="margin-left: 300px; " type="file" id="formFile">
</div>
</form>  
              </div> -->  



<?php

              if (isset($_POST['submit'])) {
    // Vérifiez si un fichier a été téléchargé
    if (!isset($_FILES['file']['name']) || $_FILES['file']['name'] == '') {
        echo "Veuillez sélectionner un fichier Excel à importer.";
        exit();
    }

    // Vérifiez si le fichier est au format Excel
    $fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if ($fileType != 'xlsx' && $fileType != 'xls') {
        echo "Veuillez télécharger un fichier Excel valide.";
        exit();
    }

    // Définir le chemin d'accès du fichier Excel
    $file = $_FILES['file']['tmp_name'];

    // Utiliser la bibliothèque PHPExcel pour lire le fichier Excel
    require_once '../PHPExcel/Classes/PHPExcel.php';
    $reader = PHPExcel_IOFactory::createReaderForFile($file);
    $worksheet = $reader->load($file);
    $rows = $worksheet->getActiveSheet()->toArray();

    // Parcourir les lignes du fichier Excel et insérer les données dans la base de données
    foreach ($rows as $key => $row) {
        if ($key == 0) continue; // Ignorer la première ligne qui contient les en-têtes de colonne

        // Définir les variables pour chaque colonne du fichier Excel
        $NOM_USER = $row[0];
        $PRENOM_USER = $row[1];
        $DATEN_USER = $row[2];
        $CIN_USER = $row[3];
        $EMAIL_USER = $row[4];
        $PASSWORD_USER = $row[5];
        $ADRESSE_USER = $row[6];
         $TELE_USER = $row[7];
        $SEXE_USER = $row[8];
        $ADM_ID_USER = $row[9];
        $TYPE_EN = $row[10];
       
        // Insérer les données dans la base de données
        $stmt = $db->query("INSERT INTO enseignant (NOM_USER, PRENOM_USER, DATEN_USER, CIN_USER,EMAIL_USER, PASSWORD_USER,TELE_USER,SEXE_USER,ADM_ID_USER,TYPE_EN) VALUES
         ( :NOM_USER, :PRENOM_USER, :DATEN_USER, :CIN_USER, :EMAIL_USER, :PASSWORD_USER, :TELE_USER, :SEXE_USER, :ADM_ID_USER, :TYPE_EN)");
        $stmt->bindParam(':NOM_USER',  $NOM_USER);
        $stmt->bindParam(':PRENOM_USER', $PRENOM_USER);
        $stmt->bindParam(':DATEN_USER', $DATEN_USER);   
        $stmt->bindParam(':CIN_USER', $CIN_USER);
        $stmt->bindParam(':EMAIL_USER', $EMAIL_USER);
        $stmt->bindParam(':PASSWORD_USER', $PASSWORD_USER);
        $stmt->bindParam(':TELE_USER', $TELE_USER);
        $stmt->bindParam(':SEXE_USER', $SEXE_USER);
        $stmt->bindParam(':ADM_ID_USER', $ADM_ID_USER);
        $stmt->bindParam(':TYPE_EN', $TYPE_EN);

        $stmt->execute();
    }

    echo "Les données ont été importées avec succès.";
}
?>

<!-- Afficher le formulaire HTML -->
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit">Importer</button>
</form>








</div>


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
                <div class="alert alert-danger">Supprimer avec succes
                    <span data-dismiss="alert" class="close">&times;</span>
                </div>
            <?php endif; ?>
        </div>

<div class="table-responsive"style="margin-top: 70px; ">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="table-primary">
                                   
                                    <th scope="col">CIN</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date Naissance</th>
                                    <th scope="col">Sexe</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Adresse</th>
                                    
                                    <th scope="col">telephone</th>
                                    
                                    
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                       $req =  $db->query("select * from enseignant");
                       while($data = $req->fetch()):
                              ?>

                              

                                <tr>
                                    <td><?= $data['CIN_USER'] ?></td>
                                   
                                    <td><?= $data['NOM_USER'] ?></td>
                                    <td><?= $data['PRENOM_USER'] ?></td>
                                    <td><?= $data['TYPE_EN'] ?></td>
                                    <td><?= $data['DATEN_USER'] ?></td>
                                    <td><?= $data['SEXE_USER'] ?></td>
                                    <td><?= $data['EMAIL_USER'] ?></td>
                                    <td><?= $data['PASSWORD_USER'] ?></td>
                                    <td><?= $data['ADRESSE_USER'] ?></td>
                                    
                                    <td><?= $data['TELE_USER'] ?></td>
                                   
                                    
                                    <td><a class="btn btn-sm btn-success" href="../Enseignement/update.php?id=<?= $data['ID_ADMIN'] ?>"><i class="bi bi-pencil-square"></i></a>
                                    <a class="btn btn-sm btn-danger" href="../Enseignement/delete.php?id=<?= $data['ID_ADMIN'] ?>"><i class="bi bi-trash3"></i></a>
                                </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>






<?php include '../include/footer.php'; ?>