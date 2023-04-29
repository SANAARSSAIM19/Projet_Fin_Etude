
<?php include '../include/connexion.php'; ?>
<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php include '../include/header2.php'; ?>

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

if(isset($_POST['submit'])){
  $NOM_DEPARTEMENT = $_POST['NOM_DEPARTEMENT'];
  $NOM_FILIERE_ = $_POST['NOM_FILIERE_'];
  $NUM_SEMESTRE = $_POST['NUM_SEMESTRE'];
  $NOM_GROUPE = $_POST['NOM_GROUPE'];
  ?>

                            <?php
                            
  $req =  $db->query("select CNE_ET,NOM_USER,PRENOM_USER,AVERTISEMENT_ET from etudiant  join affilier on etudiant.ID_ADMIN=affilier.ID_ADMIN 
  join groupe on affilier.ID_GROUPE=groupe.ID_GROUPE AND groupe.NOM_GROUPE=$NOM_GROUPE join filiere on groupe.ID_FILIERE_=filiere.ID_FILIERE_ AND filiere.NOM_FILIERE_=$NOM_FILIERE_
  join departement on filiere.ID_DEPARTEMENT=departement.ID_DEPARTEMENT AND departement.NOM_DEPARTEMENT=$NOM_DEPARTEMENT");
                       while($data = $req->fetch()):
                              ?>

                                <tr>
                                 
                                    <td><?= $data['CNE_ET'] ?></td>
                                    <td><?= $data['NOM_USER'] ?></td>
                                    <td><?= $data['PRENOM_USER'] ?></td>
                                    <td><?= $data['AVERTISEMENT_ET'] ?></td>
                   
                                </td>
                                </tr>
                                <?php endwhile; ?>
                          <?php  } ?>
                            </tbody>
                        </table>



                        <?php include '../include/footer.php'; ?>



