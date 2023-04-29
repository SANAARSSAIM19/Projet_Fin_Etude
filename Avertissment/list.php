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

$sql = 'select seance.HEURED_SEANCE,seance.HEUREF_SEANCE,etudiant.NB_absence,etudiant.AVERTISEMENT_ET from seance join absence on seance.ID_SEANCE=absence.ID_SEANCE join etudiant on absence.ID_ADMIN=etudiant.ID_ADMIN';
$rs_insert = $db->prepare($sql);
$rs_insert->execute();
$seance = $rs_insert->fetchAll();
$num_tiket = guidv4();
$sql = 'select * from etudiant ';
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
                                    <th scope="col">Avertissment</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                       $req =  $db->query("select * from etudiant");
                       while($data = $req->fetch()):
                        if($data['NB_absence']==0){ 
                            $data['AVERTISEMENT_ET'] ="discipline";
                         }else{
                            $data['AVERTISEMENT_ET'] ="aucun"; 
                         }
                              ?>
                                <tr>
                                 
                                    <td><?= $data['CNE_ET'] ?></td>
                                    <td><?= $data['NOM_USER'] ?></td>
                                    <td><?= $data['PRENOM_USER'] ?></td>
                                    <td><?= $data['AVERTISEMENT_ET'] ?></td>
        
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>


 
      <form method="post" action="ppdf.php">
    <button name="generate_pdf"class="btn btn-outline-primary"style="margin-top: 20px; ">Générer le PDF</button>
</form>




<?php include '../include/footer.php'; ?>