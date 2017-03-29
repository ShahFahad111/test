<?php
class student
 {
   public $name;
   public $rollno;
   public $rank;
   public $address;
   public $choicestatus;
   public $admissionstatus;
   public $allotmentStatus;
   public $connect;

  public function __construct()
    {
          $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "id1120660_csas";

      $this->connect = mysqli_connect($servername,$username,$password,$database);
      if(!$this->connect)
        die("unable to connect".mysqli_connect_error($this->connect));
    }

   public function getStudentDetails($rollno)
    {
         $sql = "select * from student where rollno ='$rollno'";
         $result = mysqli_query($this->connect,$sql);
         return $result;
    }
     
     
  public function getchoicestatus($rollno)
  {
      $sql = "select * from student where rollno = '$rollno'";
      $result = mysqli_query($this->connect,$sql);
      return $result;
  }

       
  public function updatechoicestatus($rollno,$status)
  {
      $sql = "update student set choice_status = '$status' where rollno ='$rollno'";
      $result = mysqli_query($this->connect,$sql);
      
      if($result)
               {
                  //  echo "choice status change ";
               }  
     else
          echo "not change ";
          
  }


  //Added By fahad

  public function getstud_detail($rank)
  {
    $sql ="select * from student where rank='$rank'";
    $result=mysqli_query($this->connect,$sql);
    $row=array();
    $row=mysqli_fetch_assoc($result);
    return $row;
  }

  public function updateAllotmentStatus($roll)
  {
    $allot="alloted";
    $sql = "update student set allotment_status='$allot' where rollno='$roll'";
    $r=mysqli_query($this->connect,$sql);
  }

public function rejectStudent($roll)
  {
    $sql="update student set choice_status=NULL,allotment_status='rejected' where rollno='$roll'";
    $res=mysqli_query($this->connect,$sql);
  }

  public function update_third_round_admission_status($roll)
  {
    $sql="update student set admission_status='confirm' where rollno='$roll'";
    $res=mysqli_query($this->conn,$sql);
  }

//Added by mushahid
public function updateAdmissionStatus($roll,$method)
{

    $alloted='alloted';
    $upgrade = 'upgrade';
    $confirm = 'confirm';
      $sql = "select * from student where rollno ='$roll' and allotment_status='$alloted'";
      $result = mysqli_query($this->connect,$sql);
   
  while($rowdata= mysqli_fetch_assoc($result))
  {
    $allot= $rowdata['allotment_status'];
    $admission= $rowdata['admission_status'];

      if(!strcmp($admission,""))
      {

          if(!strcmp($method,$upgrade))
              {
      

              $sql = "update student set admission_status = '$upgrade' where rollno = '$roll' and allotment_status='alloted'";
              $result = mysqli_query($this->connect,$sql);
     
               echo " <script> alert('Your first round addmission status has upgraded....!!!');
                window.location = ('admissiondetail.php');</script>";
          
              }
            else
            {
              $sql = "update student set admission_status = '$confirm'  where rollno = '$roll' and allotment_status='alloted'";
              $result = mysqli_query($this->connect,$sql);
               echo " <script> alert('Your admission status has confirm...!!!');
              window.location = ('admissiondetail.php');</script>";
            
          }
        }
        else
        {
            if(!strcmp($admission,$upgrade))
            {

              if(!strcmp($admission,$method))
              {

                echo " <script> alert(' Your second round status has upgrded....!!!');
                window.location = ('admissiondetail.php');</script>";
          
              }
              else
              {


                $sql = "update student set admission_status = '$method' where rollno = '$roll'";
                $result = mysqli_query($this->connect,$sql);
     
                echo " <script> alert(' Your admission status has finally confirm.....!!');
                window.location = ('admissiondetail.php');</script>";
              }

           }
           else 
           {
 
              echo " <script> alert(' Your admission status already has been confirm....!!!');
                window.location = ('admissiondetail.php');</script>";


           }
       }

    }
  

}

public function getAdmissionStudentDetails($rollno)
    {

     
       $sql = "select * from student where rollno ='$rollno'";
      $result = mysqli_query($this->connect,$sql);
   
       while($rowdata= mysqli_fetch_assoc($result))
        {
           $alloted= $rowdata['allotment_status'];
        }
      if(!strcmp($alloted,""))
      {
         echo " <script> alert(' You have no seat Alloted.......!!!!!');
                window.location = ('admissiondetail.php');</script>";
      }
      else
      {
         $sql = "select * from student where rollno ='$rollno' and allotment_status='alloted'";
         $result = mysqli_query($this->connect,$sql);
         return $result;
    }
  }



    public function getStudentCheck($roll)
      {

        // echo $roll;
           $sql="select * from student where rollno='$roll'";
           $result= mysqli_query($this->connect,$sql);
         
           if(mysqli_num_rows($result)==1)
           {
             return true;
           }
           else
           {
             return false;
           }

      }
}
?>