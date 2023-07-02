<?php include '../include/connexion.php'; ?>
<?php include '../include/header1.php'; ?>

</div><!-- End Logo -->

<div class="search-bar">
  <form method="GET" action="">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Rechercher par nom" aria-describedby="button-addon2">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit" id="button-addon2">Rechercher</button>
      </div>
    </div>
  </form>
</div><!-- End Search Bar -->

<?php include '../include/header2.php'; ?>
<?php $message='';?>

<div class="row g-3">
  <div class="col-md-3">
    <button type="button" class="btn btn-outline-primary" style="margin-top: 20px; ">
      <a class="nav-link" href="../Etudiant/add.php">Ajouter</a>
    </button>
  </div>
  <div class="col-md-9">
    <form action="" method="post" enctype="multipart/form-data">
      <label for="excel_file">Sélectionnez un fichier Excel :</label>
      <input type="file" name="excel_file" id="excel_file">
      <input type="submit" value="Importer">
    </form>
  </div>
</div>

<?php

require '../myproject/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

include '../include/connexion.php';

// Vérification que le fichier Excel a bien été envoyé
if (isset($_FILES["excel_file"]) && $_FILES["excel_file"]["error"] == UPLOAD_ERR_OK) {
    // Lecture du fichier Excel
    $spreadsheet = IOFactory::load($_FILES["excel_file"]["tmp_name"]);
    $worksheet = $spreadsheet->getActiveSheet();

    // Boucle sur les lignes du fichier Excel
    foreach ($worksheet->getRowIterator() as $row) {
        $rowData = [];
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE);

        // Boucle sur les colonnes du fichier Excel
        foreach ($cellIterator as $cell) {
            $rowData[] = $cell->getValue();
        }

        // Insertion des données dans la base de données
        $stmt = $db->prepare('INSERT INTO etudiant (NOM_USER, PRENOM_USER, DATEN_USER, CIN_USER, EMAIL_USER, PASSWORD_USER, ADRESSE_USER, TELE_USER, SEXE_USER, CNE_ET, NOM_TUTEUR_ET, PRENOM_TUTEUR_ET, ADRESS_PARENTIELLE_ET, NIVEAU_ET, AVERTISEMENT_ET, NB_absence) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute($rowData);
    }
}

// Fermeture de la connexion à la base de données


include '../include/connexion.php';


$search = isset($_GET['search']) ? $_GET['search'] : '';

$req = $db->prepare("SELECT etudiant.CIN_USER, etudiant.Id_User, etudiant.CNE_ET, etudiant.NOM_USER, etudiant.PRENOM_USER, etudiant.DATEN_USER,
  etudiant.SEXE_USER, etudiant.EMAIL_USER, etudiant.PASSWORD_USER, etudiant.ADRESSE_USER, etudiant.ADRESS_PARENTIELLE_ET, etudiant.TELE_USER, etudiant.NIVEAU_ET, filiere.ID_FILIERE_ AS ID_FILIERE_,
  filiere.NOM_FILIERE_ AS NOM_FILIERE_
  FROM etudiant
  JOIN filiere ON etudiant.ID_FILIERE_ = filiere.ID_FILIERE_
  WHERE etudiant.NOM_USER LIKE :search");

$req->bindValue(':search', '%' . $search . '%');
$req->execute();

// Rest of the code...
?>


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
    <div class="alert alert-danger">Modifier avec succès
      <span data-dismiss="alert" class="close">&times;</span>
    </div>
  <?php endif; ?>
</div>

<div class="table-responsive" style="margin-top: 70px;">
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
        <th scope="col">filiere</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($data = $req->fetch()): ?>
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
          <td><?= $data['NOM_FILIERE_'] ?></td>
          <td>
            <a class="btn btn-sm btn-success" href="../Etudiant/update.php?id=<?= $data['Id_User'] ?>">
              <i class="bi bi-pencil-square"></i>
            </a>
            <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="btn btn-sm btn-danger" href="../Etudiant/delete.php?id=<?= $data['Id_User'] ?>">
              <i class="bi bi-trash3"></i>
            </a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include '../include/footer.php'; ?>
