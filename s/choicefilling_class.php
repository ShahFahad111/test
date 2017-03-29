<html><body><?php
  class choice
   {
      public $servername;
      public $username;
      public $password;
      public $db;
      public $startDate;
      public $endDate; 
 //coneection establishment        
    public function __construct ()
    {

//server name , username , password , db according to server 
      $servername='localhost';
      $username='id1120660_csas';
      $password='csas@nitc';
      $db='id1120660_csas';
       
        $this->connect = mysqli_connect($servername,$username,$password,$db);
         if($this->connect)
        {
         //  echo "connection successfull";
        }
        else
           die("Connection failed: " . mysqli_connect_error());
    }

// function for printing choice filling of student
    public function printChoiceFilling($rollno)
       {
         $sql = "select * from choicefilling where rollno = '$rollno'";
         $result = mysqli_query($this->connect,$sql);
         
         while($row = mysqli_fetch_assoc($result))
          {
              ?><center><table style="color:black;text-transform: uppercase;width:600px;margin-left:200px;">
<tr><td><?php echo "Firstchoice  "; ?></td>
<td><?php echo $row['firstchoice']; ?></td></tr>

<tr><td><?php echo "Secondchoice  " ?> </td>
<td> 
<?php 
if(!$row['secondchoice'])
echo "Not Filled";
else
echo $row['secondchoice'];
?> </td></tr>

<tr><td> <?php echo "Thirdchoice  " ; ?></td>
<td>
<?php
if(!$row['thirdchoice'])
echo "Not Filled";
else 
echo $row['thirdchoice']; 
?> </td></tr>

<tr><td><?php echo "Fourthchoice  "; ?> </td>
<td> 
<?php 
if(!$row['fourthchoice'])
echo "Not Filled";
else 
echo $row['fourthchoice']; 
?> 
</td></tr>

<tr><td><?php echo "Fifthchoice  "; ?></td>
<td>
<?php
if(!$row['fifthchoice'])
echo "Not Filled";
else  
echo $row['fifthchoice']; 
?>
</td></tr>
</table></center>
    
    <?php
          }
       }
       
       
// filling choice in choicefilling class 
    public function fillchoice($rollno,$firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice)
           {
                
               $sql = "INSERT INTO choicefilling (rollno,firstchoice,secondchoice,thirdchoice,fourthchoice,fifthchoice) VALUES ('$rollno','$firstchoice','$secondchoice','$thirdchoice','$fourthchoice','$fifthchoice')"; 
                       
//check for data inserted or not 
              if(mysqli_query($this->connect,$sql))
                {
                     //  echo "inserted";
                }	        
              else
                   echo "not inserted"; 
           
           }


 public function printChoiceFillingdata($rollno)
       {
         $sql = "select * from choicefilling where rollno = '$rollno'";
         $result = mysqli_query($this->connect,$sql);
         return $result;
      }


//function for updating student data of choice filling 
 public function update($rollno,$firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice)
          {
  //update query            
              $sql = "UPDATE choicefilling SET firstchoice = '$firstchoice', secondchoice = '$secondchoice' , thirdchoice = '$thirdchoice' , fourthchoice = '$fourthchoice' , fifthchoice = '$fifthchoice' where rollno = '$rollno' ";
              if(mysqli_query($this->connect,$sql))
                {
                     //  echo "updated";
                }	        
              else
                   echo "not updated"; 
         } 

    } 



?>