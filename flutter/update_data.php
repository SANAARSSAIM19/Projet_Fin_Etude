<?php
// Connexion à la base de données
$mysqli = new mysqli('localhost', 'root', '7a6EQO', 'pfe_absences');

// Vérification de la connexion
if ($mysqli->connect_error) {
  die('Erreur de connexion à la base de données : ' . $mysqli->connect_error);
}

// Récupération des données du formulaire
$id = $_POST['ID_ADMIN'];
$STATUT = $_POST['STATUT'];

// Requête de mise à jour
$query = "UPDATE absence SET STATUT = '$STATUT' WHERE ID_ADMIN = '$id'";
$result = $mysqli->query($query);

// Vérification du succès de la mise à jour
if ($result) {
  echo 'Succès : entrée mise à jour avec succès!';
} else {
  echo 'Erreur lors de la mise à jour de l\'entrée.';
}

// Fermeture de la connexion à la base de données
$mysqli->close();
?>