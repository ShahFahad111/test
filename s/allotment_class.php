<?php
	class allotment
	{
		
		private $roundno;
		private $startdate;
		private $stud = array();
		private $conn;

		public function __construct()
		{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$database = "id1120660_csas";
/* Connection Check */
			$this->conn = mysqli_connect($servername,$username,$password,$database);
			if(!$this->conn)
				die("unable to connect".mysqli_connect_error($this->conn));
		}
// function for getting student details  on basis of ascending rank  
		public function getStudentData()
		{
			$sql="select * from student order by rank asc";
			$result= mysqli_query($this->conn,$sql);
			if($result)
                          {
			       while($row = mysqli_fetch_assoc($result))
				$stud[]=$row;
		          }
			return $stud;

		}

//Added by fahad for allotment round date
		public function getdate($date)
		{
			$sql="select * from allotment where start_date='$date' and allotment_held=false";
			$res=mysqli_query($this->conn,$sql);
			$r=0;
			if(mysqli_num_rows($res)==1)
			{
				$row=mysqli_fetch_assoc($res);
				$r=$row["round_number"];
			}
			return $r;
		}

	}


?>