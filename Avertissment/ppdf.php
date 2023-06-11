<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
<table>




<?php
require_once('../TCPDF-main/tcpdf.php');
if (isset($_POST['generate_pdf'])) {
    // Générer le PDF
    $pdf_content = generate_pdf();
    
    // Envoyer le PDF au navigateur
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="ma_table.pdf"');
    echo $pdf_content;
    exit;
}



function generate_pdf() {
    // Créer une nouvelle instance de TCPDF
    $pdf = new TCPDF();
    
    // Définir les métadonnées du PDF
    $pdf->SetCreator('Mon application');
    $pdf->SetAuthor('Moi');
    $pdf->SetTitle('Ma table');
    $pdf->SetSubject('Données de ma table');
    
    // Ajouter une page
    $pdf->AddPage();
    
    // Générer le tableau HTML
    $table_html = generate_table_html();
    
    // Écrire le tableau HTML dans le PDF
    $pdf->writeHTML($table_html);
    
    // Renvoyer le contenu du PDF
    return $pdf->Output('ma_table.pdf', 'S');
}

function generate_table_html() {
    // Récupérer les données de la table dans la base de données
     include '../include/connexion.php'; 
	 $html =' 
	 <h2 color="blue"style="padding-left:50%;">la liste des Etudiant </h2>
	 <table style="table{
		border-collapse: collapse;
		
	  }";> 
	<thead>
	  <tr >		
          <th style="th{
			border: solid 1px plack;
			
		  }"; scope="col">CNE</th>
	       <th style="th{
			border: solid 1px plack;
			
		  }"; scope="col">Nom</th> 
	 	 <th style="th{
			border: solid 1px plack;
			
		  }"; scope="col">Prenom</th>
		  <th style="th{
			border: solid 1px plack;
			
		  }"; scope="col">Nombre des heure </th> 

		 <th style="th{
			border: solid 1px plack;
			
		  }"; scope="col">Avertissment</th> 		
	</tr>     
	 </thead>
	 <tbody>';
    $result =$db->query("SELECT * FROM etudiant WHERE AVERTISEMENT_ET = 'Avertissement' OR AVERTISEMENT_ET = 'Discipline'");
    // Créer un tableau HTML à partir des données
    while ($row = $result->fetch()) {
        $html .= '<tr style="th{
			border: solid 1px plack;
			
		  }";>';
        $html .= '<td style="td{
			border: solid 1px plack;
			
		  }";>'.$row['CNE_ET'].'</td>';
        $html .= '<td style="td{
			border: solid 1px plack;
			
		  }";>'.$row['NOM_USER'].'</td>';
        $html .= '<td style="td{
			border: solid 1px plack;
			
		  }";>'.$row['PRENOM_USER'].'</td>'; 
		$html .= '<td style="td{
			border: solid 1px plack;
			
		}";>'.$row['NB_absence'].'</td>';
        $html .= '<td style="td{
			border: solid 1px plack;

		  }";>'.$row['AVERTISEMENT_ET'].'</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    
    return $html;
}
?>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>