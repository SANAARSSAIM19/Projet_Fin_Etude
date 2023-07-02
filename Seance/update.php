<?php
// Inclure le fichier de connexion à la base de données
include '../include/connexion.php';

// Vérifier si l'ID de la séance est passé en paramètre
if (isset($_GET['id'])) {
    $idSeance = $_GET['id'];

    // Vérifier si le formulaire a été soumis pour la mise à jour de la séance
    if (isset($_POST['submit'])) {
        $dateDebut = $_POST['date_D'];
        $heureDebut = $_POST['heure_D'];
        $dateFin = $_POST['date_F'];
        $heureFin = $_POST['heure_F'];
        $ID_ADMIN = $_POST['Id_User'];
        $NUM_SALLE = $_POST['NUM_SALLE'];
        $ID_ELEMENT = $_POST['ID_ELEMENT'];
        $ID_GROUPE = $_POST['Id_Groupe'];

        // Construire la date et l'heure de début et de fin au format DATETIME
        $dateHeureDebut = date("Y-m-d H:i:s", strtotime("$dateDebut $heureDebut"));
        $dateHeureFin = date("Y-m-d H:i:s", strtotime("$dateFin $heureFin"));

        // Vérifier si les champs obligatoires sont remplis
        if (!empty($dateHeureDebut) && !empty($dateHeureFin) && !empty($ID_ADMIN) && !empty($NUM_SALLE) && !empty($ID_ELEMENT) && !empty($ID_GROUPE)) {
            $sql = "UPDATE seance SET date_D=?, date_F=?, Id_User=?, NUM_SALLE=?, ID_ELEMENT=?, ID_GROUPE=? WHERE ID_SEANCE=?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$dateHeureDebut, $dateHeureFin, $ID_ADMIN, $NUM_SALLE, $ID_ELEMENT, $ID_GROUPE, $idSeance]);

           header('location: ../seance/list.php?msg=updated');
            exit;
        } else {
            $message = "Veuillez remplir tous les champs obligatoires.";
        }
    }

    // Récupérer les détails de la séance à partir de la base de données
    $sql = "SELECT * FROM seance WHERE ID_SEANCE=?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$idSeance]);
    $seance = $stmt->fetch();

    // Récupérer les listes d'enseignants, d'éléments et de groupes pour les options du formulaire
    $sql = "SELECT * FROM enseignant";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $enseignants = $stmt->fetchAll();

    $sql = "SELECT * FROM element";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $elements = $stmt->fetchAll();

    $sql = "SELECT * FROM groupe";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $groupes = $stmt->fetchAll();
} else {
    header('location: ../seance/list.php');
    exit;
}

?>

<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php include '../include/header2.php'; ?>



<div class="card">
    <div class="card-body">
        <h5 class="card-title">Modifier les informations de la séance</h5>
   
        <!-- No Labels Form -->
        <form class="row g-3" method="post">

            <div class="col-md-6">
                <label for="appt">Date Debut et Heure de Début:</label>
                <div class="input-group">
                    <input type="datetime-local" class="form-control" name="date_D" value="<?= date('Y-m-d\TH:i', strtotime($dateHeureDebut)); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <label for="appt">Date Fin et Heure de Fin:</label>
                <div class="input-group">
                    <input type="datetime-local" class="form-control" name="date_F" value="<?= date('Y-m-d\TH:i', strtotime($dateHeureFin)); ?>">
                </div>
            </div>

            <div class="col-12">
                <input type="number" class="form-control" placeholder="Numero de Salle" name="NUM_SALLE" value="<?= $NUM_SALLE; ?>">
            </div>

            <div class="col-md-12">
                <select class="form-select" name="Id_User" aria-label="Default select example">
                    <option selected>Nom Ensienement</option>
                    <?php
                    foreach ($enseignants as $enseignante) {
                        $id = $enseignante['Id_User'];
                        $selected = ($id == $ID_ADMIN) ? 'selected' : '';
                        echo "<option value='" . $id . "' " . $selected . ">" . $enseignante['NOM_USER'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <select id="inputState" class="form-select" name="ID_ELEMENT">
                    <option selected>Element</option>
                    <?php
                    foreach ($elements as $elemente) {
                        $id = $elemente['ID_ELEMENT'];
                        $selected = ($id == $ID_ELEMENT) ? 'selected' : '';
                        echo "<option value='" . $id . "' " . $selected . ">" . $elemente['NOM_ELEMENT'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
            <select name="Id_Groupe" id="Id_Groupe" class="form-select" required>
                    <option value="">groupe</option>
                    <?php
                    $selectFilieres = $db->query("SELECT Id_Groupe, NOM_GROUPE FROM groupe ");
                    // Récupérer les résultats de la requête dans un tableau
                    $filieres = $selectFilieres->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($filieres as $filiere) : ?>
                        <option value="<?php echo $filiere['Id_Groupe']; ?>" ><?php echo $filiere['NOM_GROUPE']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="text-center">
                <input type="hidden" name="ID_SEANCE" value="<?= $ID_SEANCE; ?>">
                <button type="submit" class="btn btn-primary" name="submit" value="modifier">Modifier</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form><!-- End No Labels Form -->
    </div>
</div>

<?php include '../include/footer.php'; ?>
