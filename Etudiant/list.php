



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
                <form>
<div class="mb-3">
  <label class="text-primary"for="formFile" class="form-label"style="margin-left: 300px; "style="margin-top: 30px; ">Ajouter un Group Etudiant</label><br>
  <input class="btn btn-outline-primary"style="margin-left: 300px; " type="file" id="formFile">
</div>
</form>                </div>
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
                                    <th scope="col">Nom_tuteur</th>
                                    <th scope="col">Prenom_tuteur</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                       $req =  $db->query("select * from etudiant");
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
                                    <td><?= $data['NOM_TUTEUR_ET'] ?></td>
                                    <td><?= $data['PRENOM_TUTEUR_ET'] ?></td>
                                    <td><a class="btn btn-sm btn-success" href="../Etudiant/update.php?id=<?= $data['ID_ADMIN'] ?>"><i class="bi bi-pencil-square"></i></a>
                                    <a class="btn btn-sm btn-danger" href="../Etudiant/delete.php?id=<?= $data['ID_ADMIN'] ?>"><i class="bi bi-trash3"></i></a>
                                </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>






<?php include '../include/footer.php'; ?>