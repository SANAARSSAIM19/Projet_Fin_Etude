
<?php include '../include/header1.php'; ?>
</div><!-- End Logo -->
<?php include '../include/header2.php'; ?>
<?php include '../include/connexion.php'; ?>

<?php
if(isset($_POST['submit'])){
  
  $ID_FILIERE_ = $_POST['ID_FILIERE_'];
  $ID_GROUPE = $_POST['Id_Groupe'];
  $ID_SEMESTRE = $_POST['ID_SEMESTRE'];
}

   ?>



                       
<?php include '../include/connexion.php'; ?>

<div class="card">
            <div class="card-body">
              <h5 class="card-title"><h5 class="text-primary">Choisir le Group des  L'Etudiants</h5></h5><br><br>
              <!-- No Labels Form -->
              <form class="row g-3"method="post" action="lister.php">
<div class="col-md-12">



                <select id="listDep" name="ID_DEPARTEMENT"   class="form-select">
                    <option value="" >Département </option>
                    <option value="1" >GI </option>
                    <option value="2" >TM  </option>
                    <option value="3">GIM  </option>
                    <option value="4">TIMQ  </option>
                  </select>
                </div>
                <div class="col-md-12">
                <select id="listFilier" class="form-select"name="ID_FILIERE_"  >
                    <option selected id="affichage">Filière</option>
                 
                  </select>
                </div>
               
                <div class="col-md-12">
                <select id="" class="form-select"name="Id_Groupe">
                    <option selected>Nom Groupe</option>
                    <option  value="1">section1 </option>
               
                    
               
                  </select>
                </div>
                <div class="col-md-12">
                <select id="inputState" class="form-select" name="ID_SEMESTRE">
                    <option selected>Semestre</option>
                    
                    <option  value="1254">S1  </option>
                    <option  value="1255">S2  </option>
                    
                    
</select>


                </div>
                <button type="submit" class="btn btn-outline-primary"name="submit"style="margin-top: 20px; " value="ok">Submit</button>


                </form>
</div>
</div>


<script src="../jquery-3.6.4.min.js"></script>
<script src="../main.js"></script>
<?php include '../include/footer.php'; ?>