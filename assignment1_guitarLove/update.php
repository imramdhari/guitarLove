
<?php 
  include_once( "server.php" );
  $userid = $_SESSION[ "userid" ];

          if ( isset( $_POST[ "update_details" ] ) ) {

	        if ( updateUserDetails( $userid, $_POST[ "name" ], $_POST[ "email" ], $_POST[ "profile" ], $_POST[ "photo_url" ] ) ) {
		        header( "Location: home.php?status=DetailsUpdated" );
	}
	       else {
		        header( "Location: home.php?status=somethingWentWrong" );
	
	}

}

$query = "SELECT name, email, password, profile,photo_url  FROM user WHERE id = '" . $userid . "'";
$results = mysqli_query( $db, $query );
if ( $row = mysqli_fetch_assoc( $results ) ) {
	$username = $row[ "name" ];
	$useremail = $row[ "email" ];
	$userbio = $row[ "profile" ];
	$photo = $row[ "photo_url" ];
	

}

 $query = "SELECT name FROM user WHERE id = '" . $userid . "'";
$results = mysqli_query( $db, $query );
if ( $row = mysqli_fetch_assoc( $results ) ) {
	$username = $row[ "name" ];
	
	

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
        	<header> 
			<?php include_once( "header.php" );?>
             </header>
                  

	
</div>      
                
				<form method="post" action="index.php">
  	                <?php include('errors.php'); ?>
	                     <div class="input-group">
  	                         <label>User ID</label>
						<?php echo ("<input type='label' name='userid' value= '". $userid . "' class='input-group'>"); ?>
  	                   
  	                     </div>
						 
  	                     <div class="input-group">
  	                         <label>User Name</label>
							 <?php echo ("<input type='text' name='username' value= '". $username . "' class='input-group'>"); ?>
  	        
  	                     </div>
						 
  	                    <div class="input-group">
  	                       <label>Email</label>
						   <?php echo ("<input type='text' name='useremail' value= '". $useremail . "' class='input-group'>"); ?>
  	                           
                       	</div>
						
            	       
	                  <div class="input-group">
  	                        <label>Your Bio</label>
							<?php echo ("<input type='text' name='userbio' value= '". $userbio . "' class='input-group'>"); ?>
  	         
                    	</div>
						
	                <div class="input-group">
  	                      <label>Enter Photo Url</label>
						  <?php echo ("<input type='text' name='userphoto' value= '". $photo . "' class='input-group'>"); ?>
  	                       
  	                </div>
  	               <div class="input-group">
  	                <button type="submit" class="btn" name="update_details" >Update Information</button>
  	                </div>
  
                   </form>






</body>
</html>
 <?php include_once( "footer.php" );?>
