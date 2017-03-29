<?php

//including classes
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

//accessing student entered data from form

     $firstchoice = $_POST['firstchoice'];
     $secondchoice = $_POST['secondchoice'];
     $thirdchoice = $_POST['thirdchoice'];
     $fourthchoice = $_POST['fourthchoice'];
     $fifthchoice = $_POST['fifthchoice'];
     $choiceredirect = $_SESSION['choiceredirect'];

//making array of choice filled by student
     $choicearray = array ($firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice);
     $obj = new choice();
     $stu = new student();
     $ins = new institute();
if(!strcmp($method,$submit))
   {
       //getting all student details 
       $nullchoice="";
       $result = $ins->getAllInstitute();
           while( $row = mysqli_fetch_assoc($result))
            {
                  $count=0;
                  $insname = $row['name'];
                  $j=0;
                  $null = 0;
                               while($j<4)
                               {
      //                            echo "comaprision b/w : ".$insname."    ".$choicearray[$j]."<br>";

     //string comparision to check how many time institute comes in entered list
                                    if(strcmp($choicearray[$j],$insname) == 0)
                                    {
                                
                                            $count++;
                                    }
          else if ((!strcmp($choicearray[$j],$nullchoice)) && (strcmp($choicearray[$j+1],$nullchoice)))
                                    {
                                     $null = 1 ;
                                     break;
                                    }
                                   if($count>=2)
                                   {
//if institute comes more then one time 
        //                                echo "more then one time";
                                        break;
                                   }
                                      
                                   $j++;
                                }
                if(($count >= 2) Or ($null == 1))
                    break;
                
            }
       
       if($count>=2)
       {
// if same choice comes more then one time 
         echo "<script>alert(\"Please fill different choices \");
					window.location=\"$redirect\";
					</script>"; 
       }
       else if ($null == 1 )
       {

//if choices are not filled in sequence 
                              echo "<script>alert(\"Please fill choices in a sequence\");
					window.location=\"$redirect\";
					</script>"; 
       }
       else
       {
// fill choice in choice filling table 
        $obj->fillchoice($rollno,$firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice);
       // $obj->printChoiceFilling($rollno);
//update choices        
$stu->updatechoicestatus($rollno,$method);
        echo "<script>alert(\"Successfully Submitted\");
					window.location=\"$redirect\";
					</script>"; 
       }
}
 else if(!strcmp($method,$update))
  {

      $method='submit';
      $nullchoice="";
//accessing institute details 
     $result = $ins->getAllInstitute();
           while( $row = mysqli_fetch_assoc($result))
            {
                  $count=0;
                  $insname = $row['name'];
                  $j=0;
                   $null = 0;
                               while($j<4)
                               {
        //                          echo "comaprision b/w : ".$insname."    ".$choicearray[$j]."<br>";
 //string comparision to check how many time institute comes in entered list
                                    if(strcmp($choicearray[$j],$insname) == 0)
                                    {
                                
                                            $count++;
                                    }
 else if ((!strcmp($choicearray[$j],$nullchoice)) && (strcmp($choicearray[$j+1],$nullchoice)))   
                                  {
// check that if current entered index data is null and next enytered data is also null
                                     $null = 1 ;
                                     break;
                                    }

                                   if($count>=2)
                                   {
          //                              echo "more then one time";
                                        break;
                                   }
                                      
                                   $j++;
                                }
                    if(($count >= 2) Or ($null == 1))
                            break;                
            }
       
       if($count>=2)
       {
         echo "<script>alert(\"Please fill different choices \");
					window.location=\"$redirect\";
					</script>"; 
       }
           else if ($null == 1 )
       {
                              echo "<script>alert(\"Please fill choices in a sequence\");
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
                  $null = 0;
                               while($j<4)
                               {
            //                      echo "comaprision b/w : ".$insname."    ".$choicearray[$j]."<br>";
                                    if(strcmp($choicearray[$j],$insname) == 0)
                                    {
                                
                                            $count++;
                                    }
                        else if ((!strcmp($choicearray[$j],"")) && (strcmp($choicearray[$j+1],"")))
                                    {
                                     $null = 1 ;
                                     break;
                                    }
                                   
                                   if($count>=2)
                                   {
              //                          echo "more then one time";
                                        break;
                                   }
                                      
                                   $j++;
                                }
                if(($count >= 2) Or ($null == 1))
                            break;  
                
            }
       
       if($count>=2)
       {
         echo "<script>alert(\"Please fill different choices \");
					window.location=\"$redirect\";
					</script>"; 
       }
     else if ($null == 1 )
       {
                              echo "<script>alert(\"Please fill choices in a sequence\");
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