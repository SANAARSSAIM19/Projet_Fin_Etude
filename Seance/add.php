<?php include '../include/connexion.php'; ?>

<?php
function guidv4($data = null) {
    // Générer 16 octets (128 bits) de données aléatoires ou utiliser les données passées en argument.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Définir la version sur 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Définir les bits 6-7 sur 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Retourner l'UUID de 36 caractères.
    return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
}

$sql = 'select * from enseignant';
$rs_insert = $db->prepare($sql);
$rs_insert->execute();
$enseignant = $rs_insert->fetchAll();
$sql = 'select * from element';
$rs_insert = $db->prepare($sql);
$rs_insert->execute();
$element = $rs_insert->fetchAll();
$num_tiket = guidv4();
$sql = 'select * from groupe';
$rs_insert = $db->prepare($sql);
$rs_insert->execute();
$groupe = $rs_insert->fetchAll();
$num_tiket = guidv4();
?>

<?php
$message = '';

if (isset($_POST['submit'])) {
    $dateDebut = $_POST['date_D'];
    $heureDebut = $_POST['heure_D'];
    $dateFin = $_POST['date_F'];
    $heureFin = $_POST['heure_F'];
    $ID_ADMIN = $_POST['Id_User'];
    $NUM_SALLE = $_POST['NUM_SALLE'];
    $ID_ELEMENT = $_POST['ID_ELEMENT'];
    $ID_GROUPE = $_POST['ID_GROUPE'];
    $ID_SEANCE = $_POST['ID_SEANCE'];
    $dateHeureDebut = date("Y-m-d H:i", strtotime("$dateDebut $heureDebut"));
    $dateHeureFin = date("Y-m-d H:i", strtotime("$dateFin $heureFin"));

    $req = $db->prepare("insert into seance(ID_SEANCE,ID_ELEMENT,ID_GROUPE,Id_User,date_D,date_F,NUM_SALLE) values(?,?,?,?,?,?,?)");
    $req->execute([$ID_SEANCE, $ID_ELEMENT, $ID_GROUPE, $ID_ADMIN, $dateHeureDebut, $dateHeureFin, $NUM_SALLE]);
    header('location: ../seance/list.php?msg=added');
}
?>

<?php require_once '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php require_once '../include/header2.php'; ?>
<?= $message; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ajouter Une Seance</h5>

        <!-- No Labels Form -->
        <form class="row g-3" method="POST">

            <div class="col-md-6">
                <label for="appt">Semaine Debut et Heure de Début:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="date_D">
                    <input type="time" class="form-control" name="heure_D">
                </div>
            </div>


            <div class="col-md-6">
                <label for="appt">Semaine et Heure de Fin:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="date_F">
                    <input type="time" class="form-control" name="heure_F">
                </div>
            </div>

           

            <div class="col-12">
                <input type="number" class="form-control" placeholder="Numero de Salle" name="NUM_SALLE">
            </div>

            <div class="col-md-12">
                <select class="form-select" name='Id_User' aria-label="Default select example">
                    <option selected>Nom Ensienement</option>
                    <?php
                    foreach ($enseignant as $enseignante) {
                        $id = $enseignante['Id_User'];
                        echo "<option value='" . $id . "' >" . $enseignante['NOM_USER'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <select id="inputState" class="form-select" name="ID_ELEMENT">
                    <option selected>Element</option>
                    <?php
                    foreach ($element as $elemente) {
                        $id = $elemente['ID_ELEMENT'];
                        echo "<option value='" . $id . "' >" . $elemente['NOM_ELEMENT'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <select id="inputState" class="form-select" name="ID_GROUPE">
                    <option selected>Groupe</option>
                    <?php
                    foreach ($groupe as $group) {
                        $id = $group['ID_GROUPE'];
                        echo "<option value='" . $id . "' >" . $group['NOM_GROUPE'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form><!-- End No Labels Form -->

    </div>
</div>

<?php include '../include/footer.php'; ?>
