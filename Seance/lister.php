<?php
$ID_DEPARTEMENT = $_POST['ID_DEPARTEMENT'];
$ID_ADMIN = $_POST['Id_User'];
?>
<?php include '../include/header1.php'; ?>

</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="get" action="../Etudiant/search.php">
    <input type="text" name="search" placeholder="Search" title="Enter search keyword" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control">
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

<div class="table-responsive" style="margin-top: 70px;">
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
        <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
       

            <?php
            $searchStartTime = isset($_GET['start_time']) ? $_GET['start_time'] : '';

          $req = $db->prepare('
          SELECT * FROM seance 
          JOIN enseignant ON seance.Id_User = enseignant.Id_User 
          JOIN groupe ON seance.ID_GROUPE = groupe.ID_GROUPE 
          JOIN element ON seance.ID_ELEMENT = element.ID_ELEMENT 
          JOIN travailler ON seance.Id_User = travailler.Id_User 
          WHERE travailler.ID_DEPARTEMENT = :ID_DEPARTEMENT AND travailler.Id_User = :Id_User 
      ');
      $req->bindParam(':ID_DEPARTEMENT', $ID_DEPARTEMENT, PDO::PARAM_INT);
      $req->bindParam(':Id_User', $ID_ADMIN, PDO::PARAM_INT);
      
            $req->execute();
            if (!empty($searchStartTime)) {
                $query .= " WHERE DATE_FORMAT(date_debut, '%H:%i') = '$searchStartTime'";
              }
            while($data = $req->fetch()):
  // Extraire l'heure de début et la semaine de début si les valeurs ne sont pas null
  $heureDebut = !empty($data['date_D']) ? date("H:i", strtotime($data['date_D'])) : '';
  $semaineDebut = !empty($data['date_D']) ? date("Y-m-d", strtotime($data['date_D'])) : '';

  // Extraire l'heure de fin et la semaine de fin si les valeurs ne sont pas null
  $heureFin = !empty($data['date_F']) ? date("H:i", strtotime($data['date_F'])) : '';
  $semaineFin = !empty($data['date_F']) ? date("Y-m-d", strtotime($data['date_F'])) : '';
            ?>
            <tr>
            <td><?= $data['NOM_ELEMENT'] ?></td>
  <td><?= $data['NOM_GROUPE'] ?></td>
  <td><?= $data['NOM_USER'] ?></td>
  <td><?= $data['PRENOM_USER'] ?></td>
  <td><?= $semaineDebut ?></td>
  <td><?= $semaineFin ?></td>
  <td><?= $heureDebut ?></td>
  <td><?= $heureFin ?></td>
  <td><?= $data['NUM_SALLE'] ?></td>
                <td>
                    <a class="btn btn-sm btn-success" href="../Seance/update.php?id=<?= $data['ID_SEANCE'] ?>"><i class="bi bi-pencil-square"></i></a> </td>
                    <td> <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="btn btn-sm btn-danger" href="../Seance/delete.php?id=<?= $data['ID_SEANCE'] ?>"><i class="bi bi-trash3"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../include/footer.php'; ?>
