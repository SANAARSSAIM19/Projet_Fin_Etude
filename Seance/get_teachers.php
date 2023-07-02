<?php
include '../include/connexion.php';

if(isset($_POST['ID_DEPARTEMENT'])) {
    $ID_DEPARTEMENT = $_POST['ID_DEPARTEMENT'];

    // Fetch teachers based on selected department
    $sql = 'SELECT * FROM enseignant JOIN travailler ON enseignant.Id_User = travailler.Id_User  WHERE travailler.ID_DEPARTEMENT = :ID_DEPARTEMENT';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':ID_DEPARTEMENT', $ID_DEPARTEMENT, PDO::PARAM_INT);
    $stmt->execute();
    $teachers = $stmt->fetchAll();

    // Generate the HTML options
    $options = '';
    foreach ($teachers as $teacher) {
        $options .= "<option value='".$teacher['Id_User']."'>".$teacher['NOM_USER']."</option>";
    }

    // Return the HTML options
    echo $options;
}
?>
