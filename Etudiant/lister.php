
<?php
  $ID_FILIERE_ = $_POST['ID_FILIERE_'];
  $ID_GROUPE = $_POST['Id_Groupe'];
  $ID_SEMESTRE = $_POST['ID_SEMESTRE'];
  ?>
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
                                  
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                          
                    <?php $query = "SELECT 
                    
                    etudiant.NOM_USER, etudiant.Id_User, etudiant.PRENOM_USER,
                     etudiant.DATEN_USER, etudiant.CIN_USER, etudiant.EMAIL_USER,
                      etudiant.PASSWORD_USER, etudiant.ADRESSE_USER, etudiant.TELE_USER,
                       etudiant.SEXE_USER, etudiant.CNE_ET, etudiant.ADRESS_PARENTIELLE_ET, 
                       etudiant.NIVEAU_ET, groupe.Id_Groupe,
                        filiere.ID_FILIERE_,etudiant.ID_FILIERE_,affilier.Id_Groupe
          FROM groupe join semestre on groupe.ID_SEMESTRE =semestre.ID_SEMESTRE
          join affilier on groupe.Id_Groupe=affilier.Id_Groupe
          join etudiant on affilier.Id_User=etudiant.Id_User
          join filiere on etudiant.ID_FILIERE_=filiere.ID_FILIERE_ 
          WHERE etudiant.ID_FILIERE_ = :ID_FILIERE_ AND affilier.Id_Groupe = :Id_Groupe AND groupe.ID_SEMESTRE= :ID_SEMESTRE";


$stmt = $db->prepare($query);
$stmt->bindParam(':ID_FILIERE_', $ID_FILIERE_);
$stmt->bindParam(':Id_Groupe', $ID_GROUPE);
$stmt->bindParam(':ID_SEMESTRE', $ID_SEMESTRE);

$stmt->execute();
                    while($data = $stmt->fetch()):
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
                                   
                                    <td><a class="btn btn-sm btn-success" href="../Etudiant/update.php?id=<?= $data['Id_User'] ?>"><i class="bi bi-pencil-square"></i></a>
                                    <a class="btn btn-sm btn-danger" href="../Etudiant/delete.php?id=<?= $data['Id_User'] ?>"><i class="bi bi-trash3"></i></a>
                                </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>






<?php include '../include/footer.php'; ?>