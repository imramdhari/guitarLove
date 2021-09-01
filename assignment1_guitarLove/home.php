
<?php 
  include_once( "server.php" );
  $userid = $_SESSION[ "userid" ];


 // session_start(); 

$query = "SELECT name, email, password, profile,photo_url  FROM user WHERE id = '" . $userid . "'";
$results = mysqli_query( $db, $query );
if ( $row = mysqli_fetch_assoc( $results ) ) {
	$username = $row[ "name" ];
	$useremail = $row[ "email" ];
	$userbio = $row[ "profile" ];
	$photo = $row[ "photo_url" ];
	

}

  if (!isset($_SESSION['userid'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['userid']);
  	header("location: login.php");
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<main>
                   
				   <h1 class="glow" align= "center">Guitar Love</h1>

                 <header>
                   
					<div class="header">

	                            <h2>User Home Page</h2>
                                 </div>  
                      
                  <nav>
                         <ul>
                                   <li><a href="home.php"><span><b>Home<b/></span></a></li>
                                       <li><a href="interest.php"><span>Add Interest</span></a></li>
                                           <li><a href="matches.php"><span>Recommendation</span></a></li>
                                               
                                            <li><a href="message.php"><span>Messages</span></a></li>
                                                  
                                                         <li><a href="update.php"><span>Edit Profile</span></a></li>
                                                             <li><a href="report.php"><span>Report</span></a></li>
                                                                  <li><a href="analytic.php"><span>Check Profile Analytics</span></a></li>
																  <li><a href="logout.php"><span>Log Out</span></a></li>
                           </ul>
                                  </nav>
								  
                        </header>
                       
                
				                       <form method="post" action="interest.php">
  	                                       <?php include('errors.php'); ?>
	                                           <div class="Welcome">
						                         
							                            <section>
  	                                                          <div>
									                              <label><h1>Welcome to Guitar Love</h1></label>
									                           </div>
									                        <div>
								                                   <?php echo ("<input type='label' name='username' value= '". $username . "' class='input-group' readonly>"); ?>
							
  	                                                          </div>
						 
  	                    </div>
  	               <div class="input-group">
				   
  	                <button type="submit" align="center" class="btn" name="interest">Click Here To Add Guitar Interest </button>
  	                </div>
  
                   </form>





<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['userId'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>
 <?php include_once( "footer.php" );?>
