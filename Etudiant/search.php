
<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="get" action="../Etudiant/search.php">
   
  </form>

  

</div><!-- End Search Bar -->
<?php include '../include/header2.php'; ?>


<?php 
		$con = mysqli_connect("localhost","root","7a6EQO","pfe_absences");
        if(isset($_GET['search'])){
        $NOM_USER = $_GET['search'];
		$sel = mysqli_query($con,"SELECT * from etudiant where NOM_USER like '%$NOM_USER%'");
	?>


<h2 style="margin-top: 70px; color:royalblue;margin-left: 450px;">resultat de recherch</h2>
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




	<?php 
        if(mysqli_num_rows($sel) > 0){
            while($data = mysqli_fetch_array($sel)) { ?>
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
        <?php }  }else {?>
            
          <?php  $message=
             '  <div class="alert alert-danger">Aucun résultat trouvé
                    <span data-dismiss="alert" class="close">&times;</span>
                </div>' ;?>

<?= $message ;?>
	
        <?php } }?>

        <?php include '../include/footer.php'; ?>



