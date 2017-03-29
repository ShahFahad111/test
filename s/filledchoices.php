<?php

class filledchoice
{
    public $connect;
    
    function __construct()
    {
        $servername="localhost";
        $username="root";
        $password="";
        $db="phpoops";
         $this->connect = new mysqli($servername,$username,$password,$db);
        if($this->connect)
            {
                 //   echo "connection successfull";
            }
        else
           die("Connection failed: " . mysqli_connect_error());
    }
    
    public function filledchoices()
    {
        $sql = "select * from filledchoicetable where rollno = 'm150059ca' ";
        $result = mysqli_query($this->connect,$sql);
        return $result;
    }
    
}
?>