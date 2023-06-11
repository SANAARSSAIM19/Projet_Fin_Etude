
<?php
$ID_DEPARTEMENT = $_POST['ID_DEPARTEMENT'];
$ID_ADMIN = $_POST['ID_ADMIN'];

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
                                    <th scope="col">Element</th>
                                    <th scope="col">Groupe</th>
                                    <th scope="col">Nom Enseignement</th>
                                    <th scope="col">Prenom Enseignement</th>
                                    <th scope="col">Heure Debut</th>
                                    <th scope="col">Heure Fin</th>
                                    <th scope="col">Numero Salle</th>
                                    <th scope="col">Modifier</th>
                                    <th scope="col">supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                          
                    <?php       
                     $req =  $db->query("
                     SELECT groupe.NOM_GROUPE,
                     enseignant.ID_ADMIN,
                     departement.ID_DEPARTEMENT,
                     element.NOM_ELEMENT,
                     enseignant.PRENOM_USER,
                     enseignant.NOM_USER,
                     HEURED_SEANCE,
                     HEUREF_SEANCE,
                     NUM_SALLE,
                     SEMAINE_D,
                     SEMAINE_F,
                     ID_SEANCE
              FROM seance
              JOIN groupe ON seance.ID_GROUPE = groupe.ID_GROUPE
              JOIN enseignant ON seance.ID_ADMIN = enseignant.ID_ADMIN
              JOIN element ON seance.ID_ELEMENT = element.ID_ELEMENT
              JOIN travailler ON enseignant.ID_ADMIN = travailler.ID_ADMIN
              JOIN departement ON travailler.ID_DEPARTEMENT = departement.ID_DEPARTEMENT
              WHERE enseignant.ID_ADMIN = $ID_ADMIN
                AND travailler.ID_DEPARTEMENT = $ID_DEPARTEMENT;  
");





                    while($data = $req->fetch()):
                     ?>
                                <tr>
                                    <td><?= $data['NOM_ELEMENT'] ?></td>
                                    <td><?= $data['NOM_GROUPE'] ?></td>
                                    <td><?= $data['NOM_USER'] ?></td>
                                    <td><?= $data['PRENOM_USER'] ?></td>
                                    <td><?= $data['HEURED_SEANCE'] ?></td>
                                    <td><?= $data['HEUREF_SEANCE'] ?></td>
                                    <td><?= $data['NUM_SALLE'] ?></td>
                                    <td><a class="btn btn-sm btn-success" href="../Seance/update.php?id=<?= $data['ID_SEANCE'] ?>"><i class="bi bi-pencil-square"></i></a>
                                    <a class="btn btn-sm btn-danger" href="../Seance/delete.php?id=<?= $data['ID_SEANCE'] ?>"><i class="bi bi-trash3"></i></a>
                                </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>






<?php include '../include/footer.php'; ?>