<?php

// Connexion à la base de données
$servername = "localhost"; // Remplacez par le nom de votre serveur MySQL
$username = "root"; // Remplacez par le nom d'utilisateur de votre base de données
$password = "7a6EQO"; // Remplacez par le mot de passe de votre base de données
$dbname = "pfe_absences"; // Remplacez par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupérer les données du formulaire ou de la requête API
 // Remplacez par le nom du champ pour le nom dans votre formulaire ou requête API
$date_absence = $_POST['STATUT']; // Remplacez par le nom du champ pour la date d'absence dans votre formulaire ou requête API
$date_absence=$conn->real_escape_string($date_absence);
// Requête SQL pour insérer les données dans la base de données
$sql = "INSERT INTO absence (STATUT) VALUES ('$date_absence')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss",  $date_absence);

// Exécution de la requête
if ($stmt->execute()) {
    echo "L'absence a été enregistrée avec succès dans la base de données.";
} else {
    echo "Erreur lors de l'enregistrement de l'absence dans la base de données : " . $stmt->error;
}

// Fermer la connexion à la base de données
$stmt->close();
$conn->close();

?>