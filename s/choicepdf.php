<?php
include('fpdf.php');
include('student_class.php');
session_start();

$firstchoice = $_SESSION['firstchoice'];
$secondchoice = $_SESSION['secondchoice'];
$thirdchoice  =  $_SESSION['thirdchoice'];
$fourthchoice  =  $_SESSION['fourthchoice'];
$fifthchoice  =  $_SESSION['fifthchoice'];
$rollno = $_SESSION['rollno'];

$stu = new student();
$result = $stu->getStudentDetails($rollno);
$studetails = mysqli_fetch_assoc($result);
$studentname = $studetails['name'];
$studentrank = $studetails['rank'];
$studentemail = $studetails['email'];


$pdfobj = new FPDF();
$pdfobj->AddPage();
$pdfobj->SetFont("Arial","B",12);
$pdfobj->Cell(0,10,"NATIONAL INSTITIUTE OF TECHNOLOGY",0,1,'C');

$pdfobj->Cell(50,10,"",0,1,'C');
$pdfobj->SetFont("Arial","B",9);

$pdfobj->Cell(0,10,"Name                           $studentname",0,1,'C');
$pdfobj->Cell(0,10,"Roll No                             $rollno",0,1,'C');
$pdfobj->Cell(0,10,"Rank                            $studentrank",0,1,'C');
//$pdfobj->Cell(00,10,"Email                             $studentemail",0,1,'C');

//$pdfobj->Cell(50,10,"Roll No : ",0,0,'C');
//$pdfobj->Cell(50,10,"$rollno",0,1,'C');

if(strcmp($firstchoice,""))
{
$pdfobj->Cell(0,10,"First Choice                           $firstchoice ",0,1,'C');
//$pdfobj->Cell(50,10,"First Choice : ",0,0,'C');
//$pdfobj->Cell(50,10,"$firstchoice",0,1,'C');
}

if(strcmp($secondchoice,""))
{
$pdfobj->Cell(0,10,"Second Choice                             $secondchoice",0,1,'C');
//$pdfobj->Cell(50,10,"Second Choice : ",0,0,'C');
//$pdfobj->Cell(50,10,"$secondchoice",0,1,'C');
}

if(strcmp($thirdchoice,""))
{
$pdfobj->Cell(0,10,"Third Choice                            $thirdchoice ",0,1,'C');
//$pdfobj->Cell(50,10,"Third Choice : ",0,0,'C');
//$pdfobj->Cell(50,10,"$thirdchoice",0,1,'C');
}

if(strcmp($fourthchoice,""))
{
$pdfobj->Cell(0,10,"Fourth Choice                           $fourthchoice ",0,1,'C');
//$pdfobj->Cell(50,10,"Fourth Choice : ",0,0,'C');
//$pdfobj->Cell(50,10,"$fourthchoice",0,1,'C');
}

if(strcmp($fifthchoice,""))
{
$pdfobj->Cell(0,10,"Fifth Choice                            $fifthchoice",0,1,'C');
//$pdfobj->Cell(50,10,"Fifth Choice : ",0,0,'C');
//$pdfobj->Cell(50,10,"$fifthchoice",0,1,'C');
}

$pdfobj->Cell(0,10,"",0,1,'C');
$pdfobj->Cell(0,10,"The candidates need to download the rank cards from the website. Candidates 
who  got  a rank  can  login  and  fill  the  choices ",0,1,'C');


$pdfobj->Cell(0,10,"of  participating  institutes  in  their  order  of  preference between date as par given in important dates. They can also modify their ",0,1,'C');


$pdfobj->Cell(0,10,"choices (or) reorder them any number of 
times before locking. It will not be possible to access their choices after locking. All the ",0,1,'C');

$pdfobj->Cell(0,10,"candidates  must have  to  lock  their  choices  on  or  before  according teh date provided in important dates.  The  choices  of  all  ",0,1,'C');

$pdfobj->Cell(0,10,"candidates  will  be automatically  locked by the server of  NIMCET-2017 after5 p.m. on 14-06-2017.",0,1,'C');

$pdfobj->output(); 

?>