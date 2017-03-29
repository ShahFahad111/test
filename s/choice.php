<?php

include('student_class.php');
include ('choicefilling_class.php');
include('connection.php');

/*Session Start */
 session_start();
$_SESSION['choice']=$_SERVER['REQUEST_URI'];
//echo $_SESSION['choice'];
$redirecthome="http://localhost/CSAS/";


$email = $_SESSION['email'];
//echo $email; 

/* Curent Time */
$now = new DateTime();
$date = $now->format('Y-m-d');

$lastdate ="2017-03-23";
$allotmentresult = "2017-03-22";

/* Object Decleration */
$stu = new student();
$obj = new choice();

//accessing student details on his email id 
$sql2 = "select * from student where email = '$email'";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($result2);

//fetching student data 
$rollno=$row2['rollno'];
$stuemail = $row2['email'];
$_SESSION['rollno']=$rollno;
//echo $rollno;

//fetching student choice status
$result = $stu->getchoicestatus($rollno);
$row = mysqli_fetch_assoc($result);
//echo "choice status : ".$row['choice_status'];

//printing choices filled by student
 $choicefill = $obj->printChoiceFillingdata($rollno);
            $choicefill = mysqli_fetch_assoc($choicefill);
           $_SESSION['firstchoice'] = $choicefill['firstchoice'];
            $_SESSION['secondchoice'] = $choicefill['secondchoice'];
             $_SESSION['thirdchoice'] = $choicefill['thirdchoice'];
              $_SESSION['fourthchoice'] = $choicefill['fourthchoice'];
                $_SESSION['fifthchoice'] = $choicefill['fifthchoice'];



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
	<h1>Choice Filling</h1>
    <div id="form">

                          <?php 

        if(!strcmp($email,$stuemail))
        {

//check for choice filling date             
   if(strtotime($date) <= strtotime($lastdate))
   {

//check for choice status          
            if(!($row['choice_status'] == 'lock'))
{
?>

        <form align="center" style="margin-top:70px;" action="fillchoiceform.php" method="post">
            <h6><p>* Please Fill Different Choices</p></h6>
        <input style="height:30px; width:300px;" type="submit" name="submit" value="fill choice"><br><br>
            <h6>  <p> Update your Filled choices </p> </h6>
        <input  style="height:30px; width:300px;" type="submit" name="submit" value="edit choice"> 
       
   <!--   <br><br> <button style="width:300px;height:30px;text-decoration:none;"><a href="http://localhost/CSAS/allotmentresult.php">Allotment Result</a></button> -->
       
 </form>
<?php
          if(strtotime($date) > strtotime($allotmentresult))
   {
?>
 <br><br> <a href="./allotmentresult.php" target="_blank"><button style="width:300px;height:30px;text-decoration:none;">Allotment Result</button></a>
  <?php  } ?>
         <br><br> <a href="logout.php"><button style="width:200px;height:30px;text-decoration:none;">logout</button></a>
        
<?php
}
else
{
//if your choice filling date is over as according to important dates then u can only see your choices
    echo "<br><h6>you can only see your choices : <h6><br>";
               
              $obj->printChoiceFilling($rollno);

//button for see allotment result , filled choice pdf , logout
     ?>
<br><a href="./choicepdf.php" target="_blank">
      <button type="submit" name="submit" value="Result Pdf" style="width:300px;height:30px;text-decoration:none;">Print choice filling </button>
        </a>
       
<?php
          if(strtotime($date) > strtotime($allotmentresult))
   {
?>
 <br><br>  <a href="./allotmentresult.php" target="_blank"><button style="width:300px;height:30px;text-decoration:none;">Allotment Result</button></a>
  <?php  } ?>
       <br><br> <a href="logout.php"><button style="width:300px;height:30px;text-decoration:none;"">logout</button></a>
        <?php 
}
   }
        else
        {

//choice filling is closed 
            echo "<h6>choice filling closed as per given into important dates </h6>";
            echo "<br><h6>you can only see your choices : <h6><br>";
             $obj->printChoiceFilling($rollno);
//button for see allotment result , filled choice pdf , logout

            ?>
<br><br><a href="https://csasallotment.000webhostapp.com/update/csas/choicepdf.php" target="_blank">
      <button type="submit" name="submit" value="Result Pdf" style="width:300px;height:30px;text-decoration:none;">Print choice filling </button>
        </a> 
<?php
          if(strtotime($date) > strtotime($allotmentresult))
   {
?>
 <br><br> <a href="./allotmentresult.php" target="_blank"><button style="width:300px;height:30px;text-decoration:none;">Allotment Result</button></a>
  <?php  } ?>

        <br><br> <a href="logout.php"><button style="width:300px;height:30px;">logout</button></a>
        <?php 
        }
    }
        else
        {
// if student is not registerted for choice filling
            echo "
            <script> alert(\"Sorry u are not registered for choice filling\");
            window.location = \"logout.php\";</script>
            ";
        }
?>
       <!-- <a href="http://localhost/CSAS/login_with_google_using_php/logout.php"><button type="submit" value="logout"></button></a> -->
 
        
        
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