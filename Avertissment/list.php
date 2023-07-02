
<?php
 $db = new PDO('mysql:host=127.0.0.1;dbname=pfe_absences;charset=utf8', 'root', '7a6EQO');
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(32);
    assert(strlen($data) == 32);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 5));
}

$sql = 'SELECT seance.date_D, seance.date_F, etudiant.NB_absence, etudiant.AVERTISEMENT_ET FROM seance JOIN absence ON seance.ID_SEANCE = absence.ID_SEANCE JOIN etudiant ON absence.Id_User = etudiant.Id_User WHERE AVERTISEMENT_ET = "Avertissement" OR AVERTISEMENT_ET = "Discipline"';
$rs_insert = $db->prepare($sql);
$rs_insert->execute();
$seance = $rs_insert->fetchAll();

$sql = 'SELECT * FROM etudiant WHERE AVERTISEMENT_ET = "Avertissement" OR AVERTISEMENT_ET = "Discipline"';
$rs_insert = $db->prepare($sql);
$rs_insert->execute();
$etudiant = $rs_insert->fetchAll();

$num_tiket = guidv4();
?>

<?php






?>
<?php include '../include/header1.php'; ?>



</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="get" action="../Avertissment/search.php">
    <input type="text" name="search" placeholder="Search" title="Enter search keyword" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" 
            class="form-control" 
                     >
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>

</div><!-- End Search Bar -->




<?php include '../include/header2.php'; ?>
<?php
 $message='';?>





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
                                   
                                    
                                    <th scope="col">CNE</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Nombre Total des heurs</th>
                                    <th scope="col">Avertissment</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                     
try {
   

     // Récupérer les étudiants avec un nombre d'absences supérieur à 6
     $sql = "SELECT * FROM etudiant WHERE nb_absence > 6";
     $stmt = $db->query($sql);
     $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
 // Mettre à jour la colonne "avertissement" en fonction du nombre d'absences

 foreach ($etudiants as $etudiant) {
    $nb_absences = $etudiant['NB_absence'];
    $avertissement = '';

    if ($nb_absences >= 12) {
        $avertissement = 'Discipline';
    } else if (($nb_absences >= 6)&&($nb_absences < 12)) {
        $avertissement = 'Avertissement';
    }

    $id_etudiant = $etudiant['Id_User'];
    $updateSql = "UPDATE etudiant SET AVERTISEMENT_ET = :AVERTISEMENT_ET WHERE Id_User = :Id_User";
    $updateStmt = $db->prepare($updateSql);
    $updateStmt->bindParam(':AVERTISEMENT_ET', $avertissement);
    $updateStmt->bindParam(':Id_User', $id_etudiant);
    $updateStmt->execute();
}


    // Récupérer les étudiants avec un nombre d'absences supérieur à 6
    $sql = "SELECT * FROM etudiant WHERE AVERTISEMENT_ET = 'Avertissement' OR AVERTISEMENT_ET = 'Discipline'";
    $stmt = $db->query($sql);
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($etudiants as $etudiant) { 
                       ?>
                         <tr>
                          
                             <td><?= $etudiant['CNE_ET'] ?></td>
                             <td><?= $etudiant['NOM_USER'] ?></td>
                             <td><?= $etudiant['PRENOM_USER'] ?></td>
                             <td><?= $etudiant['NB_absence'] ?></td>
                             <td><?= $etudiant['AVERTISEMENT_ET'] ?></td>
 
                         </tr>
                       
                         <?php  } ?>
                     </tbody>
                 </table>
             </div>
             <?php
    // Afficher les résultats
   
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


                    ?>


 
      <form method="post" action="ppdf.php">
    <button name="generate_pdf"class="btn btn-outline-primary"style="margin-top: 20px; ">Générer le PDF</button>
</form>




<?php include '../include/footer.php'; ?>