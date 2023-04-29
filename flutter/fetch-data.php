<?php
// Connexion à la base de données
$servername = "localhost"; // Remplacez par le nom de votre serveur MySQL
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = "7a6EQO"; // Remplacez par votre mot de passe MySQL
$dbname = "pfe_absences"; // Remplacez par le nom de votre base de données MySQL

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Requête SQL pour récupérer les données de la base de données
$sql = "SELECT NOM_USER,PRENOM_USER FROM etudiant"; // Remplacez 'table_etudiants' par le nom de votre table

$result = $conn->query($sql);

// Tableau pour stocker les données
$data = array();

// Vérification des résultats de la requête
if ($result->num_rows > 0) {
    // Parcourir les résultats et stocker les données dans le tableau
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convertir le tableau en format JSON
    echo json_encode($data);
} else {
    // Si aucune donnée trouvée
    echo "Aucune donnée trouvée";
}

// Fermer la connexion
$conn->close();
?>