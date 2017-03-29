<?php
	class seat
	{
		private $seat;
		private $conn;
		
		public function __construct()
		{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$database = "id1120660_csas";

			$this->conn = mysqli_connect($servername,$username,$password,$database);
			if(!$this->conn)
				die("unable to connect".mysqli_connect_error($this->conn));
		}
		public function getSeatStatus($roll)
		{
			$sql = "select * from seat where student_rollno='$roll'";
			$result = mysqli_query($this->conn,$sql);
			return $result;
		}

		public function updateSeatStatus($roll)
		{
			$sql = "select institute_name,seat_status,student_rollno from seat where student_rollno='$roll'";
			$result = mysqli_query($this->conn,$sql);
			if($result)
			{
				if(mysqli_num_rows($result)==1)
				{
					 $sql = "update seat set seat_status=1 where student_rollno='$roll' and seat_status=0";
					$result=mysqli_query($this->conn,$sql);
					if($result)
					{
						//echo "updated seat status";
					}
					else
					{
						//echo "can't update seat status";
					} 

				}
				else
				{
					//echo "No such student with the given roll";
				}
			}
			else
			{
				//echo "Sql query not running";
			}
		}


		public function allot_seat($institute,$roll)
		{
			$sql = "insert into seat values('$institute','$roll')";
			$res = mysqli_query($this->conn,$sql);
		}

		public function delete_seat($roll)
		{
			$sql = "select institute_name from seat where student_rollno='$roll'";
			$res = mysqli_query($this->conn,$sql);
			$row = mysqli_fetch_assoc($res);
			$inst = $row["institute_name"];
			$sql = "delete from seat where student_rollno ='$roll'";
			$res = mysqli_query($this->conn,$sql);
			return $inst;

		}

	}

?>