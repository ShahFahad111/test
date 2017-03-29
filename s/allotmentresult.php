<?php

//including classes
include('student_class.php');
include ('choicefilling_class.php');
include('connection.php');
include('seat_class.php');

/* Session Start */
 
session_start();
$redirect = $_SESSION['choice'];


//check mail comes or not 
if ($_SESSION['email'])
{
    //echo "Yes, mail is set";    
}else{  
    echo "<script>alert(\"please do your login first\");
					window.location=\"$redirect\";
					</script>";
}

//accesing student rollno
$rollno=$_SESSION['rollno'];
	

/* Current Time */
$now = new DateTime();
$date = $now->format('Y-m-d');

$lastdate ="2017-03-18";

/* Object Decleration */

$stu = new student();
$obj = new choice();
$seat= new seat();

// Function Calling  for student details 
$result = $stu->getStudentDetails($rollno);
$row = mysqli_fetch_assoc($result);

//accessing student seat status 
$alloted = $seat->getSeatStatus($rollno);
$allotresult = mysqli_fetch_assoc($alloted);
//echo "alloted indtitute : ".$allotresult['institute_name'];

       $_SESSION['name'] = $row['name'];
       $_SESSION['rollno'] = $row['rollno'];
       $_SESSION['rank'] = $row['rank'];
       $_SESSION['email'] = $row['email'];
       $_SESSION['allotment_status'] = $row['allotment_status'];
       $_SESSION['institiute_name'] = $allotresult['institute_name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSAS</title>
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />

</head>

<body>

<div id="templatemo_wrapper">
	
    <div id="templatemo_header">

	<div id="site_title">
		<h1><a href="#" target="_parent">
		<strong>CSAS</strong>
		<span>Central Seat Allotment</span>
		</a></h1>
	</div>
	
	<div class="twitter">
			<a href="http://www.nitc.ac.in/">Organizing Institute <br/><span>NIT CALICUT</span></a>
	</div>
	
</div> <!-- end of templatemo_header -->
<div id="templatemo_menu">

</div> 
<!-- end of templatemo_menu -->
    
    <div id="templatemo_content_wrapper">
	
		<div id="templatemo_content">
        
        	﻿<html>
<style type="text/css">
.NormalTable {
		color:white;
		font-family:"Tahoma","sans-serif";
		
}
tr:hover {
	background-color: rgba(129,208,177,.3);
}


p.MsoNoSpacing
	{margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	margin-left: 0cm;
	margin-right: 0cm;
	margin-top: 0cm;
}
a:link
	{color:blue;
	text-decoration:underline;
	text-underline:single;
}
.auto-style1 {
	border-width: 0px;
}
.auto-style2 {
	border-style: solid;
	border-width: 1px;
}
#choice{
	padding:20px;
	margin-left:auto;
	margin-right:auto;
	width:850px;
	height:600px;
	background-color:#F0F8FF;
	color:black;
	border:2px inset black;
	padding: 15px 5px 5px 5px;
}
if(strtotime($date) <= strtotime($lastdate))
    {
    
    #choice h1{
	font-weight:bold;
	font-color:black;
}

#form{
	padding:20px;
	width:650px;
	height:500px;
	border:2px solid red;
	text-align:center;
	margin:0 auto;
}
</style>
<div class=Section1 style="padding-left:50px;"align="center">
  
  <div id="choice">
	<h1>Allotment Result</h1>
    <div id="form">

                          <?php 

//check for current date and last date for allotment result
   if(strtotime($date) >= strtotime($lastdate))
   {
//printing student details 
         ?>
       <table style="color:black;width:600px;margin-left:200px;"  cellspacing="10">
        <tr><td>Name</td><td><?php echo $row['name']; ?></td></tr>
        <tr><td>Roll no</td><td><?php echo $row['rollno']; ?></td></tr>
        <tr><td>Rank</td><td><?php echo $row['rank']; ?></td></tr>
        <tr><td>Email</td><td><?php echo $row['email']; ?></td></tr>
        <tr><td>Allotment Status</td><td><?php 
        if(!$row['allotment_status'])
        echo "Not Alloted";
        else
        echo $row['allotment_status']; 
         ?></td></tr>
        <tr><td>Allotment Institute</td><td>
        <?php
        if(!$allotresult['institute_name'])
        echo "Not Alloted";
        else
        echo $allotresult['institute_name']; 
         ?></td></tr>
        </table>
        <?php
   }
        else
        {

        //if result is not decleared 
         echo "<script>alert(\"Sorry ,See your result on date of  result decleration\");
					window.location=\"$redirect\";
					</script>";
        }
?>
<br><a href="https://csasallotment.000webhostapp.com/update/csas/allotmentresultpdf.php" target="_blank">
      <button type="submit" name="submit" value="Result Pdf" style="width:200px;height:30px;text-decoration:none;">Result Pdf</button>
        </a>
    </div>
</div>


	


<br /><br />
</div>
<br />

</html>
            
    	</div> <!-- end of templatemo_content -->
    
		<div id="templatemo_sidebar">
	
	
	
	<div class="cleaner"></div>
</div> <!-- end of sidebar -->
            
        <div class="cleaner">
      
        
        </div>
		
    </div> <!-- end of templatemo_content_wrapper -->
    
   <div id="templatemo_footer" align="center">


	<table>
						<tr>
							<td><img src = "images/au.png" height = "50px" width = "70px"></td>
							<td><img src = "images/sa.svg" height = "50px" width = "70px"></td>
							<td><img src = "images/west.png" height = "50px" width = "70px"></td>
							<td><img src = "images/lk.png" height = "50px" width = "70px"></td>
							<td><img src = "images/6.jpg" height = "50px" width = "70px"></td>
							<td><img src = "images/rusia.jpg" height = "50px" width = "70px"></td>
							<td><img src = "images/afg.png" height = "50px" width = "70px"></td>
							<td><img src = "images/bhu.png" height = "50px" width = "70px"></td>
							<td><img src = "images/ger.png" height = "50px" width = "70px"></td>
							<td><img src = "images/ban.png" height = "50px" width = "70px"></td>
							<td><img src = "images/mal.png" height = "50px" width = "70px"></td>
						</tr>
					</table>
	
</div> <!-- end of templatemo_footer -->
<div align="center">Copyright by<strong> NIT CALICUT</strong>  @2017</div>

</div> <!-- end of wrapper -->

</body>
</html>