<?php


require("fpdf.php");

    $InterLigne=7;
    $pdf=new FPDF();
if(isset($_POST['create'])){
$numcom=$_POST['numcom'];
$datecom=$_POST['datecom'];
$idclient=$_POST['idclient'];
$idprd=$_POST['idprd'];
$quantite=$_POST['quantite'];
$total=$_POST['total'];


$pdf->AddPage();
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->setFillColor(230,230,230);
$pdf->SetX(70);
$pdf->cell(60,8,'Facture',0,1,'C',1);
$pdf->setFillColor(255,255,255);

$pdf->SetFont('Helvetica', '', 11);

$pdf->cell(50,6,'Numero de client:'.$idclient,0,1,'L',1);
$pdf->cell(50,6,'date de facture:'.$datecom,0,1,'L',1);
$pdf->cell(50,6,'Numero de Facture:'.$idf,0,1,'L',1);
$pdf->Ln(20);

    

    $pdf->SetDrawColor(183);
    $pdf->setTextColor(0);
    $pdf->setFillColor(230,230,230);


    $pdf->SetX(10);
    $pdf->cell(60,8,'ip',1,0,'C',1);
    $pdf->SetX(70);
    $pdf->cell(60,8,'quantite',1,0,'C',1);
    $pdf->SetX(130);
    $pdf->cell(60,8,'total',1,0,'C',1);
    $pdf->Ln();
    $pdf->setFillColor(255,255,255);

    $pdf->SetX(10);
    $pdf->cell(60,8,$idprd,1,0,'C',1);
    $pdf->SetX(70);
    $pdf->cell(60,8,$quantite,1,0,'C',1);
    $pdf->SetX(130);
    $pdf->cell(60,8,$total,1,0,'C',1);

}

