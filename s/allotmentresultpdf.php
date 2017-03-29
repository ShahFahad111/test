<?php
include('fpdf.php');
// include('choicefilling_class.php');
session_start();


       $name = $_SESSION['name'];
       $rollno = $_SESSION['rollno'];
       $rank = $_SESSION['rank'] ;
       $email = $_SESSION['email'];
       $allotment_status = $_SESSION['allotment_status'];
       $institiute_name = $_SESSION['institiute_name'];




$pdfobj = new FPDF();
$pdfobj->AddPage();
$pdfobj->SetFont("Arial","B",12);

$pdfobj->Cell(0,10,"NATIONAL INSTITIUTE OF TECHNOLOGY",0,1,'C');
$pdfobj->Cell(50,10,"",0,1,'R');
$pdfobj->SetFont("Arial","B",9);
$pdfobj->Cell(0,10,"Based on choice filled by the following candidate and his/her All India Rank,secured in Entrance Exam,",0,1,'C');
$pdfobj->Cell(0,10,"a seat in MCA programme is provisionally alloted. The allotted institute details along with personal ",0,1,'C');
$pdfobj->Cell(0,10,"details , along with personal details,registered by the candidate are mentioned below",0,1,'C');

$pdfobj->Cell(0,10,"",0,1,'C');

$pdfobj->Cell(0,10,"Name                              $name ",0,1,'C');
//$pdfobj->Cell(0,10,"$name",0,1,'C');

$pdfobj->Cell(0,10,"Roll No                              $rollno ",0,1,'C');
//$pdfobj->Cell(50,10,"Roll No : ",0,0,'R');
//$pdfobj->Cell(50,10,"$rollno",0,1,'R');

$pdfobj->Cell(0,10,"Rank                              $rank ",0,1,'C');
//$pdfobj->Cell(50,10,"Rank : ",0,0,'R');
//$pdfobj->Cell(50,10,"$rank",0,1,'R');

//$pdfobj->Cell(0,10,"Email                             $email",0,1,'C');
//$pdfobj->Cell(50,10,"Email : ",0,0,'R');
//$pdfobj->Cell(50,10,"$email",0,1,'R');

$pdfobj->Cell(0,10,"Allotment Status                             $allotment_status ",0,1,'C');
//$pdfobj->Cell(50,10,"Allotment Status : ",0,0,'R');
//$pdfobj->Cell(50,10,"$allotment_status",0,1,'R');

$pdfobj->Cell(0,10,"Institute Name                             $institiute_name ",0,1,'C');
//$pdfobj->Cell(50,10,"Institute Name : ",0,0,'R');
//$pdfobj->Cell(50,10,"$institiute_name",0,1,'R');

$pdfobj->Cell(50,10,"",0,1,'R');
$pdfobj->Cell(0,10,"Candidate is required to report during 14th July to 15th July,2017 between 10:00 A.M to 05:00 P.M",0,1,'C');
$pdfobj->Cell(0,10,"personally at the alloted institute with this letter,provisional allotment/admission letter if any",0,1,'C');
$pdfobj->Cell(0,10,"issue during previous round of reporting, and original documents/certificate for final admission.",0,1,'C');


$pdfobj->output();
?>