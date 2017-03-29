<?php

// including classes
include ('./choicefilling_class.php');
include ('./student_class.php');
include ('./institute.php');

/* variable declaration */
$submit='submit';
$edit='edit';
$lock='lock';
$update = 'update';
$method = $_POST['submit'];

/* Session Start */
session_start();
$rollno =$_SESSION['rollno'];
$_SESSION['rollno'] = $rollno;
$redirect = $_SESSION['choiceredirect'];

//accessing student choice filling data from form 
     $firstchoice = $_POST['firstchoice'];
     $secondchoice = $_POST['secondchoice'];
     $thirdchoice = $_POST['thirdchoice'];
     $fourthchoice = $_POST['fourthchoice'];
     $fifthchoice = $_POST['fifthchoice'];
     $choiceredirect = $_SESSION['choiceredirect'];

//making array of choice filled by student
     $choicearray = array ($firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice);

//object creation   
  $obj = new choice();
     $stu = new student();
     $ins = new institute();

//check for method is its submit or upgrade or lock
if(!strcmp($method,$submit))
   {
    // echo"submit function";

//geting all institute details
       $result = $ins->getAllInstitute();
           while( $row = mysqli_fetch_assoc($result))
            {
                  $count=0;
                  $insname = $row['name'];
                  $j=0;
                               while($j<5)
                               {
      //                            echo "comaprision b/w : ".$insname."    ".$choicearray[$j]."<br>";

//string comparision b/w inserted institute or institutes in institute class               
if(strcmp($choicearray[$j],$insname) == 0)
                                    {
                                
                                            $count++;
                                    }
                                   
//if institute comes more then one time
                                   if($count>=2)
                                   {
        //                                echo "more then one time";
                                        break;
                                   }
                                      
                                   $j++;
                                }
                if($count >= 2)
                    break;
                
            }
       
       if($count>=2)
       {
         echo "<script>alert(\"Please fill different choices \");
					window.location=\"$redirect\";
					</script>"; 
       }
       else
       {
        $obj->fillchoice($rollno,$firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice);
        $obj->printChoiceFilling($rollno);
        $stu->updatechoicestatus($rollno,$method);
        echo "<script>alert(\"Successfully Submitted\");
					window.location=\"$redirect\";
					</script>"; 
       }
       
   }
 else if(!strcmp($method,$update))
  {
      $method='submit';
      //echo"edit function";
      
      
       $result = $ins->getAllInstitute();
           while( $row = mysqli_fetch_assoc($result))
            {
                  $count=0;
                  $insname = $row['name'];
                  $j=0;
                               while($j<5)
                               {
        //                          echo "comaprision b/w : ".$insname."    ".$choicearray[$j]."<br>";
                                    if(strcmp($choicearray[$j],$insname) == 0)
                                    {
                                
                                            $count++;
                                    }
                                   
                                   if($count>=2)
                                   {
          //                              echo "more then one time";
                                        break;
                                   }
                                      
                                   $j++;
                                }
                if($count >= 2)
                    break;
                
            }
       
       if($count>=2)
       {
         echo "<script>alert(\"Please fill different choices \");
					window.location=\"$redirect\";
					</script>"; 
       }
       else
       {
      
    $obj->update($rollno,$firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice);
   // $obj->printChoiceFilling($rollno);
    $stu->updatechoicestatus($rollno,$method);
      
      echo "<script>alert(\"Successfully Updated\");
					window.location=\"$redirect\";
					</script>";
  }
  }
else if(!strcmp($method,$lock))
  {
        
       $result = $ins->getAllInstitute();
           while( $row = mysqli_fetch_assoc($result))
            {
                  $count=0;
                  $insname = $row['name'];
                  $j=0;
                               while($j<5)
                               {
            //                      echo "comaprision b/w : ".$insname."    ".$choicearray[$j]."<br>";
                                    if(strcmp($choicearray[$j],$insname) == 0)
                                    {
                                
                                            $count++;
                                    }
                                   
                                   if($count>=2)
                                   {
              //                          echo "more then one time";
                                        break;
                                   }
                                      
                                   $j++;
                                }
                if($count >= 2)
                    break;
                
            }
       
       if($count>=2)
       {
         echo "<script>alert(\"Please fill different choices \");
					window.location=\"$redirect\";
					</script>"; 
       }
       else
       {
      
    //echo"edit function";
    $obj->update($rollno,$firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice);
   // $obj->printChoiceFilling($rollno);
    $stu->updatechoicestatus($rollno,$method);
      
      echo "<script>alert(\"Successfully Locked\");
					window.location=\"$redirect\";
					</script>";
  }
  }
?>