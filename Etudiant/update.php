<?php
include '../include/connexion.php';

$message = '';

if (isset($_POST['submit'])) {
    $ID_FILIERE_ = $_POST['ID_FILIERE_'];
    $NOM_USER = $_POST['NOM_USER'];
    $PRENOM_USER = $_POST['PRENOM_USER'];
    $DATEN_USER = $_POST['DATEN_USER'];
    $CIN_USER = $_POST['CIN_USER'];
    $EMAIL_USER = $_POST['EMAIL_USER'];
    $PASSWORD_USER = $_POST['PASSWORD_USER'];
    $ADRESSE_USER = $_POST['ADRESSE_USER'];
    $TELE_USER = $_POST['TELE_USER'];
    $SEXE_USER = $_POST['SEXE_USER'];
    $ADRESS_PARENTIELLE_ET = $_POST['ADRESS_PARENTIELLE_ET'];
    $NIVEAU_ET = $_POST['NIVEAU_ET'];
    $var_id = $_POST['Id_User'];

    $sql2 = "UPDATE etudiant SET ID_FILIERE_ = ?, NOM_USER = ?, PRENOM_USER = ?, DATEN_USER = ?, CIN_USER = ?, EMAIL_USER = ?, PASSWORD_USER = ?, ADRESSE_USER = ?, TELE_USER = ?, SEXE_USER = ?, ADRESS_PARENTIELLE_ET = ?, NIVEAU_ET = ? WHERE Id_User = ?";
    $rs_modif = $db->prepare($sql2);

    $rs_modif->bindValue(1, $ID_FILIERE_, PDO::PARAM_INT);
    $rs_modif->bindValue(2, $NOM_USER, PDO::PARAM_STR);
    $rs_modif->bindValue(3, $PRENOM_USER, PDO::PARAM_STR);
    $rs_modif->bindValue(4, $DATEN_USER, PDO::PARAM_STR);
    $rs_modif->bindValue(5, $CIN_USER, PDO::PARAM_STR);
    $rs_modif->bindValue(6, $EMAIL_USER, PDO::PARAM_STR);
    $rs_modif->bindValue(7, $PASSWORD_USER, PDO::PARAM_STR);
    $rs_modif->bindValue(8, $ADRESSE_USER, PDO::PARAM_STR);
    $rs_modif->bindValue(9, $TELE_USER, PDO::PARAM_STR);
    $rs_modif->bindValue(10, $SEXE_USER, PDO::PARAM_STR);
    $rs_modif->bindValue(11, $ADRESS_PARENTIELLE_ET, PDO::PARAM_STR);
    $rs_modif->bindValue(12, $NIVEAU_ET, PDO::PARAM_STR);
    $rs_modif->bindValue(13, $var_id, PDO::PARAM_INT);
    
    $rs_modif->execute();
        header('location: ../Etudiant/list.php?msg=updated');
        $message='   <div class="alert alert-success" role="alert">
        Enseignement modifier
      </div> ';
}

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM etudiant WHERE Id_User = ?";
    $rs_insert = $db->prepare($sql);
    $var_id = $_GET['id'];
    $rs_insert->bindValue(1, $var_id, PDO::PARAM_INT);
    $rs_insert->execute();
    $donnees = $rs_insert->fetch(PDO::FETCH_ASSOC);

    $NOM_USER = $donnees['NOM_USER'];
    $PRENOM_USER = $donnees['PRENOM_USER'];
    $DATEN_USER = $donnees['DATEN_USER'];
    $CIN_USER = $donnees['CIN_USER'];
    $EMAIL_USER = $donnees['EMAIL_USER'];
    $PASSWORD_USER = $donnees['PASSWORD_USER'];
    $ADRESSE_USER = $donnees['ADRESSE_USER'];
    $TELE_USER = $donnees['TELE_USER'];
    $SEXE_USER = $donnees['SEXE_USER'];
    $CNE_ET = $donnees['CNE_ET'];
    $ADRESS_PARENTIELLE_ET = $donnees['ADRESS_PARENTIELLE_ET'];
    $NIVEAU_ET = $donnees['NIVEAU_ET'];
} else {
    $NOM_USER = '';
    $PRENOM_USER = '';
    $DATEN_USER = '';
    $CIN_USER = '';
    $EMAIL_USER = '';
    $PASSWORD_USER = '';
    $ADRESSE_USER = '';
    $TELE_USER = '';
    $SEXE_USER = '';
    $CNE_ET = '';
    $ADRESS_PARENTIELLE_ET = '';
    $NIVEAU_ET = '';
}
?>

<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php include '../include/header2.php'; ?>

<?= $message; ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Modifier les informations de l'étudiant</h5>

        <!-- No Labels Form -->
        <form class="row g-3" method="post">
            <div class="col-md-12">
                <input type="text" value="<?= $NOM_USER; ?>" class="form-control" placeholder="Nom" name="NOM_USER" id="NOM_USER">
            </div>
            <div class="col-md-12">
                <input type="text" value="<?= $PRENOM_USER ?>" class="form-control" placeholder="Prenom" name="PRENOM_USER" id="PRENOM_USER">
            </div>
            <div class="col-md-6">
                <input type="text" value="<?= $CIN_USER ?>" class="form-control" placeholder="CIN" name="CIN_USER" id="CIN_USER">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="<?= $CNE_ET ?>" placeholder="CNE" name="CNE_ET" id="CNE_ET">
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" value="<?= $DATEN_USER ?>" placeholder="Date Naissance" name="DATEN_USER" id="DATEN_USER">
            </div>
            <div class="col-md-6">
                <select id="inputState" class="form-select" name="SEXE_USER" id="SEXE_USER">
                    <option selected>Sexe</option>
                    <option <?= ($SEXE_USER === 'femme') ? 'selected' : '' ?>>femme</option>
                    <option <?= ($SEXE_USER === 'Homme') ? 'selected' : '' ?>>Homme</option>
                    <option <?= ($SEXE_USER === 'Autre') ? 'selected' : '' ?>>Autre</option>
                </select>
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control" value="<?= $EMAIL_USER ?>" placeholder="Email" name="EMAIL_USER" id="EMAIL_USER">
            </div>
            <div class="col-md-6">
                <input type="password" class="form-control" value="<?= $PASSWORD_USER ?>" placeholder="Password" name="PASSWORD_USER" id="PASSWORD_USER">
            </div>
            <div class="col-12">
                <input type="text" class="form-control" value="<?= $ADRESSE_USER ?>" placeholder="Adresse" name="ADRESSE_USER" id="ADRESSE_USER">
            </div>
            <div class="col-12">
                <input type="text" class="form-control" value="<?= $ADRESS_PARENTIELLE_ET ?>" placeholder="Adresse Parentielle" name="ADRESS_PARENTIELLE_ET" id="ADRESS_PARENTIELLE_ET">
            </div>
            <div class="col-md-4">
                <input type="telephone" class="form-control" value="<?= $TELE_USER ?>" placeholder="telephone" name="TELE_USER" id="TELE_USER">
            </div>
            <div class="col-md-4">
                <select id="inputState" class="form-select" name="NIVEAU_ET" id="NIVEAU_ET">
                    <option selected>Niveau</option>
                    <option <?= ($NIVEAU_ET === '1 Annee') ? 'selected' : '' ?>>1 Annee</option>
                    <option <?= ($NIVEAU_ET === '2 Annee') ? 'selected' : '' ?>>2 Annee</option>
                    <option <?= ($NIVEAU_ET === 'LP') ? 'selected' : '' ?>>LP</option>
                </select>
            </div>
            <div class="col-md-4">
                <select name="ID_FILIERE_" id="ID_FILIERE_" class="form-select" required>
                    <option value="">Filiere</option>
                    <?php
                    $selectFilieres = $db->query("SELECT ID_FILIERE_, NOM_FILIERE_ FROM filiere ");
                    // Récupérer les résultats de la requête dans un tableau
                    $filieres = $selectFilieres->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($filieres as $filiere) : ?>
                        <option value="<?php echo $filiere['ID_FILIERE_']; ?>" ><?php echo $filiere['NOM_FILIERE_']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="text-center">
                <input type="hidden" name="Id_User" value="<?= $var_id; ?>">
                <button type="submit" class="btn btn-primary" name="submit" value="modifier">Modifier</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form><!-- End No Labels Form -->

    </div>
</div>
<?php include '../include/footer.php'; ?>
