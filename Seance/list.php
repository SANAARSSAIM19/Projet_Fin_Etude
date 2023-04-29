



<?php include '../include/header1.php'; ?>



</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="get" action="../Seance/search.php">
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
<div class="col-md-12">
<button type="button" class="btn btn-outline-primary"style="margin-top: 20px; "> <a class="nav-link " href="../Seance/add.php">Ajouter</a></button>
                </div>
      
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
                                   
                                    <th scope="col">Element</th>
                                    <th scope="col">Groupe</th>
                                    <th scope="col">Nom Enseignement</th>
                                    <th scope="col">Prenom Enseignement</th>
                                    <th scope="col">Debut Semaine</th>
                                    <th scope="col">Fin Semaine</th>
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
                       select seance.HEURED_SEANCE,
                       seance.HEUREF_SEANCE,
                       seance.NUM_SALLE,
                       seance.ID_SEANCE,
                       seance.SEMAINE_D,
                       seance.SEMAINE_F,
                       departement.ID_DEPARTEMENT,
                       element.NOM_ELEMENT,
                       enseignant.NOM_USER ,
                       enseignant.ID_ADMIN ,
                       enseignant.PRENOM_USER,
                       groupe.NOM_GROUPE 
                       from seance
                       join groupe on seance.ID_GROUPE=groupe.ID_GROUPE
                       join filiere on groupe.ID_FILIERE_=filiere.ID_FILIERE_
                       join departement on filiere.ID_DEPARTEMENT = departement.ID_DEPARTEMENT 
                       join travailler on departement.ID_DEPARTEMENT=travailler.ID_DEPARTEMENT   
                       join  enseignant on travailler.ID_ADMIN = enseignant.ID_ADMIN
                       join  element on enseignant.ID_ADMIN=element.ID_ADMIN  ;");
                       while($data = $req->fetch()):
                              ?>

                              

                                <tr>
                                    <td><?= $data['NOM_ELEMENT'] ?></td>
                                    <td><?= $data['NOM_GROUPE'] ?></td>
                                    <td><?= $data['NOM_USER'] ?></td>
                                    <td><?= $data['PRENOM_USER'] ?></td>
                                    <td><?= $data['SEMAINE_D'] ?></td>
                                    <td><?= $data['SEMAINE_F'] ?></td>
                                    <td><?= $data['HEURED_SEANCE'] ?></td>
                                    <td><?= $data['HEUREF_SEANCE'] ?></td>
                                    <td><?= $data['NUM_SALLE'] ?></td>
                                    <td><a class="btn btn-sm btn-success" href="../Seance/update.php?id=<?= $data['ID_SEANCE'] ?>"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <td>
                                <a class="btn btn-sm btn-danger" href="../Seance/delete.php?id=<?= $data['ID_SEANCE'] ?>"><i class="bi bi-trash3"></i></a>

                                </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>






<?php include '../include/footer.php'; ?>