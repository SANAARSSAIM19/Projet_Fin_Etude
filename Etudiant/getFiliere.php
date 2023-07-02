<?php
// Include le fichier de connexion à la base de données
include '../include/connexion.php';

if (isset($_POST['depId'])) {
  $depId = $_POST['depId'];
  
  // Requête pour récupérer les filières en fonction du département
  $query = "SELECT * FROM filiere WHERE id_departement = :depId";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':depId', $depId);
  $stmt->execute();
  
  $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($stmt->rowCount() > 0) {
    // Générer les options des filières
    $output = '<option selected id="affichage">Filière</option>';
    foreach ($filieres as $filiere) {
      $output .= '<option value="' . $filiere['id_filiere'] . '">' . $filiere['nom_filiere'] . '</option>';
    }
  } else {
    $output = '<option selected id="affichage">Filière</option>';
  }
  
  echo $output;
}
?>
