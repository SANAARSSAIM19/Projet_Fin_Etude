
<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php include '../include/header2.php'; ?>
<?php include '../include/connexion.php'; ?>

<?php
if(isset($_POST['submit'])){
  $NOM_DEPARTEMENT = $_POST['NOM_DEPARTEMENT'];
  $NOM_FILIERE_ = $_POST['NOM_FILIERE_'];
  $NOM_GROUPE = $_POST['NOM_GROUPE'];
  $NUM_SEMESTRE = $_POST['NUM_SEMESTRE'];
}

   ?>



                       

<div class="card">
            <div class="card-body">
              <h5 class="card-title"><h5 class="text-primary">Choisir le Group des  L'Etudiants</h5></h5><br><br>
              <!-- No Labels Form -->
              <form class="row g-3"method="post" action="lister.php">
<div class="col-md-12">



                <select id="listDep" name="NOM_DEPARTEMENT"   class="form-select">
                    <option value="" >Département </option>
                    <option value="1" >GI </option>
                    <option value="2" >TM  </option>
                    <option value="3">GIM  </option>
                    <option value="4">TIMQ  </option>
                  </select>
                </div>
                <div class="col-md-12">
                <select id="listFilier" class="form-select"name="NOM_FILIERE_"  >
                    <option selected id="affichage">Filière</option>
                 
                  </select>
                </div>
               
                <div class="col-md-12">
                <select id="listGroup" class="form-select"name="NOM_GROUPE">
                    <option selected>Nom Groupe</option>
                    <option  value="5">Cour </option>
                    <option value="6" >TD1  </option>
                    <option  value="7">TD2  </option>
                    <option  value="1">TP1  </option>
                    <option  value="2">TP2  </option>
                    <option  value="3">TP3  </option>
                    <option  value="4">TP4  </option>
                    
               
                  </select>
                </div>
                <div class="col-md-12">
                <select id="inputState" class="form-select"name="NUM_SEMESTRE">
                    <option selected>Semestre</option>
                    <option value="1">Semestre 1</option>
                    <option value="2">Semestre 2</option>
                    <option value="3">Semestre 3 </option>
                    <option value="4">Semestre 4</option>
                    <option value="5">Semestre 5 </option>
                    <option value="6">Semestre 6</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-outline-primary"name="submit"style="margin-top: 20px; " value="ok">Submit</button>


                </form>
</div>
</div>


<script src="../jquery-3.6.4.min.js"></script>
<script src="../main.js"></script>
<?php include '../include/footer.php'; ?>