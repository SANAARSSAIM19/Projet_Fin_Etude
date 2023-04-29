
<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php include '../include/header2.php'; ?>


<?php 
		$con = mysqli_connect("localhost","root","7a6EQO","pfe_absences");
        if(isset($_GET['search'])){
        $CNE_ET = $_GET['search'];
		$sel = mysqli_query($con,"SELECT * from etudiant where CNE_ET like '%$CNE_ET%'");
	?>


<h2 style="margin-top: 70px; color:royalblue;margin-left: 450px;">resultat de recherch</h2>
<div class="table-responsive"style="margin-top: 70px; ">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="table-primary">
                                   
                                <th scope="col">CNE</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Avertissement</th>
                                   
                                </tr>
                            </thead>
                            <tbody>




	<?php 
        if(mysqli_num_rows($sel) > 0){
            while($data = mysqli_fetch_array($sel)) { ?>
                <tr>
                <td><?= $data['CNE_ET'] ?></td>
                                   
                                   <td><?= $data['NOM_USER'] ?></td>
                                   <td><?= $data['PRENOM_USER'] ?></td>
                                   <td><?= $data['AVERTISEMENT_ET'] ?></td>
                                 
                
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



