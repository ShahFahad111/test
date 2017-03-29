<?php
include('fpdf.php');
include('student_class.php');
include('seat_class.php');
session_start();

$rollno = $_SESSION['rollno'];
$stuobj = new student();
$seatobj = new seat();

$seatresult = $seatobj->getSeatStatus($rollno);
$stuseatdata = mysqli_fetch_assoc($seatresult);


$result = $stuobj->getStudentDetails($rollno);
$studata = mysqli_fetch_assoc($result);


$name = $studata['name']; 
$rank = $studata['rank'];
$admissionstatus = $studata['admission_status'];
$institutename= $stuseatdata['institute_name'];


$pdfobj = new FPDF();
$pdfobj->AddPage();
$pdfobj->SetFont("Arial","B",12);

$pdfobj->Cell(0,10,"NATIONAL INSTITIUTE OF TECHNOLOGY",0,1,'C');
$pdfobj->Cell(50,10,"",0,1,'R');
$pdfobj->SetFont("Arial","B",9);

$pdfobj->Cell(0,10,"Based on choice filled by the following candidate and his/her All India Rank,secured in Enterance Exam,",0,1,'C');
$pdfobj->Cell(0,10,"a seat in MCA programme is provisionally alloted. The allotted institute details along with personal ",0,1,'C');
$pdfobj->Cell(0,10,"details , along with personal details,registered by the candidate are mentioned below",0,1,'C');
$pdfobj->Cell(0,10,"",0,1,'C');
$pdfobj->Cell(0,10,"NAME                              $name",0,1,'C');
$pdfobj->Cell(0,10,"Roll No                           $rollno ",0,1,'C');
$pdfobj->Cell(0,10,"Rank                              $rank ",0,1,'C');
$pdfobj->Cell(0,10,"Institute Name                    $institutename",0,1,'C');
$pdfobj->Cell(0,10,"Admission Status                $admissionstatus",0,1,'C');

$pdfobj->output();
?>