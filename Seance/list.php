<?php include '../include/header1.php'; ?>

</div><!-- End Logo -->


<div class="search-bar">
  <form method="GET" action="">
    <div class="input-group mb-3">
      <input type="text" name="start_time" class="form-control" placeholder="Search start time" aria-describedby="button-addon2">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit" id="button-addon2">Rechercher</button>
      </div>
    </div>
  </form>
</div><!-- End Search Bar -->
<?php include '../include/header2.php'; ?>
<?php $message=''; ?>
<?php include '../include/connexion.php'; ?>

<div class="row g-3">
  <div class="col-md-12">
    <button type="button" class="btn btn-outline-primary" style="margin-top: 20px;">
      <a class="nav-link" href="../Seance/add.php">Ajouter</a>
    </button>
  </div>
</div>

<div class="col-md-8 mx-auto">
  <?php if(isset($_GET['msg']) && $_GET['msg']=='added'):  ?>
    <div class="alert alert-success">Ajouter avec succès
      <span data-dismiss="alert" class="close">&times;</span>
    </div>
  <?php endif; ?>
  <?php if(isset($_GET['msg']) && $_GET['msg']=='updated'):  ?>
    <div class="alert alert-warning">Modifier avec succès
      <span data-dismiss="alert" class="close">&times;</span>
    </div>
  <?php endif; ?>
  <?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'):  ?>
    <div class="alert alert-danger">Supprimer avec succès
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

$query = "
  SELECT groupe.NOM_GROUPE, element.NOM_ELEMENT, enseignant.PRENOM_USER, enseignant.NOM_USER, date_D, date_F, NUM_SALLE, ID_SEANCE
  FROM seance
  JOIN groupe ON seance.ID_GROUPE = groupe.ID_GROUPE
  JOIN enseignant ON seance.Id_User = enseignant.Id_User
  JOIN element ON seance.ID_ELEMENT = element.ID_ELEMENT";

if (!empty($searchStartTime)) {
  $query .= " WHERE DATE_FORMAT(date_debut, '%H:%i') = '$searchStartTime'";
}

$req = $db->query($query);
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
  <td><a class="btn btn-sm btn-success" href="../Seance/update.php?id=<?= $data['ID_SEANCE'] ?>"><i class="bi bi-pencil-square"></i></a></td>
  <td><a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="btn btn-sm btn-danger" href="../Seance/delete.php?id=<?= $data['ID_SEANCE'] ?>"><i class="bi bi-trash3"></i></a></td>
</tr>
<?php endwhile; ?>


<?php include '../include/footer.php'; ?>
