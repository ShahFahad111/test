<?php

//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
	//Initialize User class
	$user = new User();
	
	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
    );
    $userData = $user->checkUser($gpUserData);
	
	//Storing user data into session
	$_SESSION['userData'] = $userData;
	$redirect = "https://csasallotment.000webhostapp.com/update/csas/choice.php";
	//Render facebook profile data
    if(!empty($userData)){
        $output = '<h1>Google+ Profile Details </h1>';
        $output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Google';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="logout.php">Google</a>';
        $_SESSION['email']= $userData['email'];
       echo"
             <script>alert(\"successfully Login\");
			 
                window.location=\"$redirect\";
               </script>";
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
	$authUrl = $gClient->createAuthUrl();
	/*it is a change */
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'" id = "test">Login With Google</a>';
	/*change ends here*/
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<head>
		<style>
			/*it is a change */
			#test 
			{
				color:white;
				font-size: 20px;
				width: 40%;
				margin-left:27%;
			    background-color: #f44336;
			    color: white;
			    padding: 14px 25px;
			    text-align: center;
			    text-decoration: none;
			    display: inline-block;
			}
			/*change ends here */

			table {
				
				border-collapse: collapse;
				width: 100%;
			}

			th, td {
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even){background-color: #f2f2f2}

			th {
				background-color: #4CAF50;
				color: white;
			}
			
			}
            
h1{font-family:Arial, Helvetica, sans-serif;color:#999999;}
    
    .divback{
    background-image: url('loginback4.jpg');
   margin-top:10%;
   margin-left:25%;
        width: 600px;
        height: 400px;
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
				<strong>CSAS - 2017</strong>
				<span>Central Seat Allotment System</span>
				
				
				</a></h1>
				
			</div>
			
			<div class="twitter">
					
					<a href="http://www.nitc.ac.in/">Organizing Institute <br/><span>NIT CALICUT</span></a>
			</div>
			
		</div> <!-- end of templatemo_header -->
		<div id="templatemo_menu">

			<ul>
				
				<li><a href="index.php" 
					class="current first" >Home</a></li>
				<li><a href="participating_nits.php" 
					 >Participating NITs</a></li>
				<li><a target="_blank" href="seat_matrix.pdf" 
					 >Seat Matrix</a></li>
				<li><a href="imp_dates.php" 
					 >Important Dates</a></li>
				<li><a href="contact.php"  >Contact</a></li>
					</ul> 
		</div> 
		<!-- end of templatemo_menu -->
			
			<div id="templatemo_content_wrapper">
				<div class="cleaner"></div>
				<div style="background:url(images/templatemo_slider.png); padding:5px;">
<marquee behavior="alternate" style="color:#FF0000"><strong> Choice Filling will start from 10<sup> th</sup>March 2017. CSAC-2017 Host Institute is NIT CALICUT.</strong></marquee>
				</div>
				<div id="templatemo_slider">
					<div id="one" class="contentslider">
						<div class="cs_wrapper">
							<div class="cs_slider">
								<div class="cs_article">
				 <!-- <div class="article_content" >  -->
	<center><h2 style="color:red;"></h2>
    <img style="width:80px;height:110px;"src="./images/x.png"></center><br>
    <?php echo $output; ?>
								<!-- </div> -->
							
								</div><!-- End cs_article -->
						
							</div><!-- End cs_slider -->
						</div><!-- End cs_wrapper -->
					</div><!-- End contentslider -->
						
						<!-- Site JavaScript -->
				</div> <!-- end of slider -->
					   
				<div id="templatemo_sidebar">
					<div class="cleaner"></div>
				</div> <!-- end of sidebar -->
					
				<div class="cleaner">
					
				</div>
				<div id="templatemo_slider">
					<div id="one" class="contentslider">
						<div class="cs_wrapper">
							<div class="cs_slider">
								<div class="cs_article">
									<div class="article_content">
										<p align="justify">


NIT MCA is one of the heighly recognized course in INDIA and also outside of india.
Course Structure is designed such as per industry requirments. 
MCA Students are most required in outside of india i.e Austrailia Japan USA as well as UK. National Institute of technology (NITs) are institute of national importance and are centrally founded Technical institute .
 The CSAS(Central Seat Allotment System) is a NIT MCA Common Entrance Test a national level test conducted by NITs for admissionin to their MCA program.
  The Admission to the MCA Program in NITs at AGARTALA ALLAHABAD BHOPAL CALICUT DURGAPUR JAMSHEDPUR KURUKSHETRA TRICHY and WARANGAL for the year is based on the Rank obtained-- in CSAS 2017 ONLY . 
  The curiculum and syllabus of master of Computer Application (MCA) Program in NITs are designed consideration the need of different information Technology firm Mca graduates have highly potential for jobs in IT sector.

										</p>
									</div>
							
								</div><!-- End cs_article -->
						
							</div><!-- End cs_slider -->
						</div><!-- End cs_wrapper -->
					</div><!-- End contentslider -->
						
						<!-- Site JavaScript -->
				</div> <!-- end of slider -->
			</div> <!-- end of templatemo_content_wrapper -->
				<div id="templatemo_footer" align="center">
					<table>
						<tr>
							<td><img src = "images/au.png" height = "50px" width = "70px"></td>
							<td><img src = "images/sa.svg" height = "50px" width = "70px"></td>
							<td><img src = "images/west.png" height = "50px" width = "70px"></td>
							<td><img src = "images/lk.png" height = "50px" width = "70px"></td>
							<td><img src = "images/6.jpg" height = "50px" width = "70px"></td>
							<td><img src = "images/rusia.jpg" height = "50px" width = "70px"></td>
							<td><img src = "images/afg.png" height = "50px" width = "70px"></td>
							<td><img src = "images/bhu.png" height = "50px" width = "70px"></td>
							<td><img src = "images/ger.png" height = "50px" width = "70px"></td>
							<td><img src = "images/ban.png" height = "50px" width = "70px"></td>
							<td><img src = "images/mal.png" height = "50px" width = "70px"></td>
						</tr>
					</table>
				</div> <!-- end of templatemo_footer -->
				<div align="center">Copyright by<strong> NIT CALICUT</strong>  @2017</div>

		</div> <!-- end of wrapper -->
	</body>
</html>