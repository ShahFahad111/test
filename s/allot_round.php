<?php
	session_start();
	if(!isset($_SESSION["name"])){
        echo " <script> alert('Please Login first');
                window.location = ('adminlogins.php');</script>";
    }
//include classes 

	include('student_class.php');
	//include('filledchoices.php');
	include('institute.php');
	include('seat_class.php');
	include('allotment_class.php');
	include('connection.php');

// accesing current date for first round of allotment 
// creating DateTime class object

	$now = new DateTime();
	$date = $now->format('y-m-d');

// starting date of allotment
 
	$lastdate = "2017-03-19";

	if(strtotime($date) > strtotime($lastdate))
	{

// creating class objects 
		$stud_obj = new student();
		//$choice_obj = new filledchoice();
		$inst_obj = new institute();
		$seat_obj = new seat();
		$allot_obj = new allotment();


// Getting student details and rank in (ascending order) from student table using allotment_class

		$stud_detail = array();
		$stud_detail = $allot_obj->getStudentData();


// Deleting seat of those student who have not reported
		foreach($stud_detail as $tmp)
		{
			$stu = array();
			$stu = $stud_obj->getstud_detail($tmp["rank"]);
			$rl = $stu["rollno"];

// delete those student who have been alloted institute but not reported for counselling
if($stu["choice_status"]=="lock" and $stu["allotment_status"]=="alloted" and $stu["admission_status"]=="")
			{
				$in = $seat_obj->delete_seat($rl);
				$inst_obj->addVacantSeat($in);
				$stud_obj->rejectStudent($rl);
			}	
		}





//alloting to each student seat for second round 
		foreach($stud_detail as $data)
		{
			$student=array();
			
			$student = $stud_obj->getstud_detail($data["rank"]);

//wheather choice is lock or not  
			if($student["choice_status"]=="lock")
			{

//check for eligible student for upgradation and confirm 				
	   if($student["admission_status"]=="" || $student["admission_status"]=="upgrade")
				{

					$roll=$student["rollno"];

					if($student["admission_status"]=="upgrade")
					{
						$in = $seat_obj->delete_seat($roll);
						$inst_obj->addVacantSeat($in);
					}
//fetching student choice fillings
					$sql="select * from choicefilling where rollno='$roll'";
					$result = mysqli_query($conn,$sql);
					$choice = array();
					$choice = mysqli_fetch_assoc($result);
	                                $choice_result = array($choice["firstchoice"],$choice["secondchoice"],$choice["thirdchoice"],$choice["fourthchoice"],$choice["fifthchoice"]);
			
					//alloting institute to student
					for($i=0;$i<count($choice_result);$i++)
					{
						if($inst_obj->isVacant($choice_result[$i]))
						{
							$seat_obj->allot_seat($choice_result[$i],$roll);
							$inst_obj->updateVacantSeat($choice_result[$i]);
							$stud_obj->updateAllotmentStatus($roll);
						//echo "<br>breaking point :".$i."<br>";
							break;
						}

					}

				}
				
			}
			else
				echo "choice not locked";
		}
		$sql = "update allotment set allotment_held=true where round_number=2";
			$res = mysqli_query($conn,$sql);
		echo " <script> alert('Allotment completed!!!!');
                window.location = ('admissiondetail.php');</script>";
	}
?>