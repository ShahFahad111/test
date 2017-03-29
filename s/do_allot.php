<?php
	session_start();
	if(!isset($_SESSION["name"])){
        echo " <script> alert('Please Login first');
                window.location = ('adminlogins.php');</script>";
    }
	include('student_class.php');
	//include('filledchoices.php');
	include('institute.php');
	include('seat_class.php');
	include('allotment_class.php');
	include('connection.php');

	$now = new DateTime();
	$date = $now->format('y-m-d');
	//echo "<br>date : $date<br/>";
	$lastdate = "2017-03-18";
	

	if(strtotime($date) > strtotime($lastdate))
	{
		$sql="update student set choice_status='lock' where choice_status='submit'";
		$r = mysqli_query($conn,$sql);
		$stud_obj = new student();
		//$choice_obj = new filledchoice();
		$inst_obj = new institute();
		$seat_obj = new seat();
		$allot_obj = new allotment();


		//Getting student rollno and rank(ascending order) from student table using allotment_class
		$stud_detail = array();
		$stud_detail = $allot_obj->getStudentData();


		//alloting to each student on rank ascending
		foreach($stud_detail as $data)
		{
			$student=array();
			$student = $stud_obj->getstud_detail($data["rank"]);
			

			if($student["choice_status"]=="lock")
			{
				$roll=$student["rollno"];
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
						break;
					}

				}
			}

		}
			$sql = "update allotment set allotment_held=true where round_number=1";
			$res = mysqli_query($conn,$sql);
			
		echo " <script> alert(' First round allotment completed!!!!');
                window.location = ('admissiondetail.php');</script>";
	}
	else
		echo "<br>Allotment date is has not come.";

?>