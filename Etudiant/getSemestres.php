<?php
// Include le fichier de connexion à la base de données
include '../include/connexion.php';

if (isset($_POST['groupId'])) {
  $groupId = $_POST['groupId'];
  
  // Requête pour récupérer les semestres en fonction du groupe
  $query = "SELECT * FROM semestre WHERE ID_GROUPE = :groupId";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':groupId', $groupId);
  $stmt->execute();
  
  $semestres = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($stmt->rowCount() > 0) {
    // Générer les options des semestres
    $output = '<option selected id="affichage">Semestre</option>';
    foreach ($semestres as $semestre) {
      $output .= '<option value="' . $semestre['id_semestre'] . '">' . $semestre['num_semestre'] . '</option>';
    }
  } else {
    $output = '<option selected id="affichage">Semestre</option>';
  }
  
  echo $output;
}
?>
