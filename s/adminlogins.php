<html>
<head>
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 3% 0 0;
  margin: auto;
}
body{

  background-image: url("life.jpg"); 
}
#Admin
{
  border-radius: 10px;
  text-align: center;
  background-color:#90992C;
  height:100px;
  padding-top:50px;
  font-size:50px;
  opacity: .7; 

}

.form {
  
  background-color:#90992C;
  position: relative;
  z-index: 1;
  background: #90992C;
  width: 400px;

  margin-top:0px;
  margin-left:0px;
  margin-bottom: 90px;
  margin-right:auto;
  padding: 25px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 18px;
   border-radius: 8px;

}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 500px;
  margin: 0 auto;

}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
</style>
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
    <span>Central Seat Allotment System</span>
    </a></h1>
  </div>
  
  <div class="twitter">
      <a href="http://www.nitc.ac.in/">Organizing Institute <br/><span>NIT CALICUT</span></a>
  </div>
  
</div> <!-- end of templatemo_header -->
<div id="templatemo_menu">

</div> 
</div>
<div id= "Admin">
  
<h1 style="font-size:60px;">Admin Panel </h1>

</div>
<div class="login-page">
  <div class="form">
    <form class="login-form" method ="post" >
      <input type="text" name="name" placeholder="username" required="required"/>
      <input type="password" name="pass" placeholder="password" required="required"/>
      <input type="submit" name="submit" value="Admin Login">
    </form>



  </div>
</div>
</body>
</html>




<?php

     $servername='localhost';  
          $username='root';
          $password='';
          $db='id1120660_csas';
        
        $connect = new mysqli($servername,$username,$password,$db);

if(isset($_POST['submit']))
{

   $name=$_POST['name'];
   $pass=$_POST['pass'];

  $sql= "select * from admin where name ='$name' and password ='$pass'";
  
  
  $res= mysqli_query($connect,$sql);

  if(mysqli_num_rows($res)>0)
  {
    session_start();
    $_SESSION["name"]=$name;
     echo " <script> alert(' You are Login Here......!!!!!');
                window.location = ('admissiondetail.php');</script>";

  }
  else
  {
     echo " <script> alert(' Your Id and Password Wrong ......!!!!!');
                window.location = ('adminlogins.php');</script>";

  }
}

?>