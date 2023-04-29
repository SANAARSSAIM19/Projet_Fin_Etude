
<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php include '../include/header2.php'; ?>
<?php include '../include/connexion.php'; ?>

<?php
function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    // Set bits 6-7 to 10

    // Output the 36 character UUID.
    return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
}

	$sql = 'select * from enseignant';
	$rs_insert = $db->prepare($sql);
	$rs_insert->execute();
	$enseignant = $rs_insert->fetchAll();
    
?>



<?php
if(isset($_POST['submit'])){
  $ID_DEPARTEMENT = $_POST['ID_DEPARTEMENT'];
  $ID_ADMIN = $_POST['ID_ADMIN'];
}
   ?>



                       

<div class="card">
            <div class="card-body">
              <h5 class="card-title"><h5 class="text-primary">Choisir les Seance</h5></h5><br><br>
              <!-- No Labels Form -->
              <form class="row g-3"method="post" action="lister.php">
<div class="col-md-12">



                <select  name="ID_DEPARTEMENT"   class="form-select">
                    <option value="" >Département </option>
                    <option value="1" >GI </option>
                    <option value="2" >TM  </option>
                    <option value="3">GIM  </option>
                    <option value="4">TIMQ  </option>
                  </select>
                </div>
                <div class="col-md-12">
                <select  class="form-select"name="ID_ADMIN"  >
                    <option selected id="affichage">Enseignement</option>
                    <?php
									    foreach($enseignant as $enseignante){
                                            $id = $enseignante['ID_ADMIN'];
											echo "<option value='".$id."' >".$enseignante['NOM_USER']."</option>";
										}
									?>
                  </select>
                </div>
               
                <button type="submit" class="btn btn-outline-primary"name="submit"style="margin-top: 20px; " value="ok">Submit</button>


                </form>
</div>
</div>


<script src="../jquery-3.6.4.min.js"></script>
<script src="../main.js"></script>
<?php include '../include/footer.php'; ?>