
<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php include '../include/header2.php'; ?>


<?php 
		$con = mysqli_connect("localhost","root","7a6EQO","pfe_absences");
        if(isset($_GET['search'])){
        $HEURED_SEANCE = $_GET['search'];
		$sel = mysqli_query($con,"SELECT * from seance 
join groupe on seance.ID_GROUPE=groupe.ID_GROUPE join filiere on groupe.ID_FILIERE_=filiere.ID_FILIERE_
join departement on filiere.ID_DEPARTEMENT=departement.ID_DEPARTEMENT join enseignant on enseignant.ID_ADMIN=departement.ID_ADMIN
join  element on enseignant.ID_ADMIN=element.ID_ADMIN
        where HEURED_SEANCE like '%$HEURED_SEANCE%'");
	?>


<h2 style="margin-top: 70px; color:royalblue;margin-left: 450px;">resultat de recherch</h2>
<div class="table-responsive"style="margin-top: 70px; ">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="table-primary">
                                   
                                    <th scope="col">Nom Element</th>
                                    <th scope="col">Nom Group</th>
                                    <th scope="col">Nom Enseignement</th>
                                    <th scope="col">Prenom Enseignement</th>
                                    <th scope="col">Heure Debut</th>
                                    <th scope="col">Heure Fin</th>
                                    <th scope="col">Numero Salle</th>
                                   

                                  
                                    
                                </tr>
                            </thead>
                            <tbody>




	<?php 
        if(mysqli_num_rows($sel) > 0){
            while($data = mysqli_fetch_array($sel)) { ?>
                <tr>
                <td><?= $data['NOM_ELEMENT'] ?></td>
                                    <td><?= $data['NOM_GROUPE'] ?></td>
                                    <td><?= $data['NOM_USER'] ?></td>
                                    <td><?= $data['PRENOM_USER'] ?></td>
                                    <td><?= $data['HEURED_SEANCE'] ?></td>
                                    <td><?= $data['HEUREF_SEANCE'] ?></td>
                                    <td><?= $data['NUM_SALLE'] ?></td>
            
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



