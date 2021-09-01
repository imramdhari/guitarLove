<?php
session_start();

// initializing variables
$userid = "";
$username= "";
$email    = "";
$userbio = "";
$userphoto= "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'itech3108_30348843_a1');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $userid = mysqli_real_escape_string($db, $_POST['userid']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $userbio = mysqli_real_escape_string($db, $_POST['userbio']);
  $userphoto = mysqli_real_escape_string($db, $_POST['userphoto']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($userid)) { array_push($errors, "UserId is required"); }
  if (empty($username)) { array_push($errors, "Username is required"); }
   if (empty($userbio)) { array_push($errors, "User Bio is required"); }
    if (empty($userphoto)) { array_push($errors, "User Photo Url is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
 // if (empty($userprofile)) { array_push($errors, "Bio is required"); }
 // if (empty($photo_url)) { array_push($errors, "Photo url is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE id='$userid' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['id'] === $userid) {
      array_push($errors, "User ID already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = get_hash($password_1);//encrypt the password before saving in the database
	
  	$query = "INSERT INTO user (id,name, email, password,profile,photo_url) 
  			  VALUES('$userid','$username', '$email', '$password','$userbio','$userphoto')";
  	mysqli_query($db, $query);
  	$_SESSION['userid'] = $userid;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: home.php');
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {

  $userid = mysqli_real_escape_string($db, $_POST['userid']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  

  if (empty($userid)) {
  	array_push($errors, "User ID is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
  	$password = get_hash($password);
	echo $password;
  	$query = "SELECT name FROM user WHERE id='$userid' AND password='$password' LIMIT 1";
  	$results = mysqli_query($db, $query);
	if ( !$results || mysqli_affected_rows( $db ) > 0 ) {
		return true;
	} else {
		$_SESSION['userid'] = $userid;
  	  $_SESSION['success'] = "You are now logged in";
	
	  echo "check1";
  	  header('location: home.php');
		return false;
	}
	
  	if ($results==1) {
  	  
  	}else {
		echo "check21";
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

//update User
function updateProfile($username,$useremail,$userbio,$userphoto){
if (isset($_POST['update_details'])) {

  if (empty($userid)) {
  	array_push($errors, "User ID is required");
  }
  if (empty($username)) {
  	array_push($errors, "User Name is required");
  }
  if (empty($useremail)) {
  	array_push($errors, "User email is required");
  }
  if (empty($userbio)) {
  	array_push($errors, "User bio is required");
  }
  if (empty($userphoto)) {
  	array_push($errors, "User Photo URL is required");
  }
  }

  if (count($errors) == 0) {
  	/*$query = "UPDATE user SET id = '" . $userid . "', name = " . $username . ", email = " . $useremail . ",profile = " . $userbio . " ,profile_url = " . $userphoto . " WHERE id = " . $userid;
echo "check2";
  	$results = mysqli_query($db, $query);
	echo "check3";
	if ( !$results || mysqli_affected_rows( $db ) > 0 ) {
		$_SESSION['success'] = "Your Information has been updated now";
  	  header('location: update.php');
		return true;
	} 
	else {
		array_push($errors, "Wrong username/password combination");
		return false;
	}
 
  }*/
  
  $query = "UPDATE user SET name = '" . $username . "', email = " . $useremail . ", profile = " . $userbio . ", photo_url = " . $userphoto . " WHERE id = " . $userid;

	global $db;
	$results = mysqli_query( $db, $query );

	if ( !$results || mysqli_affected_rows( $db ) > 0 ) {
		return true;
	} else {
		return false;
	}

}
}


function addTagToUser( $userid, $guitarid ) {

	$query = "INSERT INTO likes ( user_id, guitar_id) VALUES (" . $userid . ", " . $guitarid . ")";
	global $db;
	$results = mysqli_query( $db, $query );

	if ( !$results || mysqli_affected_rows( $db ) > 0 ) {
		return true;
	} else {
		return false;
	}

}

function removeTagFromUser( $userid, $guitarid ) {

	$query = "DELETE FROM likes WHERE userid = " . $userid . " AND guitarid = " . $guitarid;

	global $db;
	$results = mysqli_query( $db, $query );

	if ( !$results || mysqli_affected_rows( $db ) > 0 ) {
		return true;
	} else {
		return false;
	}

}

/*function addGuitar( $tagname ) {

	$query = "INSERT INTO guitar ( title ) VALUES ('" . $tagname . "')";

	global $db;
	$results = mysqli_query( $db, $query );

	if ( !$results || mysqli_affected_rows( $db ) > 0 ) {
		return true;
	} else {
		return false;
	}

}

function removeGuitar( $tagid ) {

	$query = "DELETE FROM guitar WHERE tagid = " . $tagid;

	global $db;
	$results = mysqli_query( $db, $query );

	if ( !$results || mysqli_affected_rows( $db ) > 0 ) {
		return true;
	} else {
		return false;
	}

}
*/
function getCurrentUserTags( $userid ) {
	$query = "SELECT title FROM guitar, likes WHERE likes.guitar_id = guitar.id AND user_id = " . $userid . " ORDER BY guitar.title";
	global $db;
	$results = mysqli_query( $db, $query );

	$temp = array();

	while ( $row = mysqli_fetch_assoc( $results ) ) {

		array_push( $temp, $row[ "title" ]);
	}
	return $temp;

}
function checkUserTagExist( $userid, $guitarid ) {
	$query = "SELECT * FROM likes WHERE user_id = " . $userid . " AND guitar_id = " . $guitarid;
	global $db;
	$results = mysqli_query( $db, $query );
	$row = mysqli_fetch_assoc( $results );
	if ( $row && $results ) {
		return true;
	} else {
		return false;
	}
}
function redirect( $type ) {
	if ( $type == "admin" ) {
		header( "Location: login.php" );
	} else {
		header( "Location: login.php" );
	}
}

date_default_timezone_set('Australia/Melbourne');
function fetch_user_last_activity($userid, $db)
{
 $query = "
 SELECT * FROM login_details 
 WHERE user_id = '$userid' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement;
 foreach($result as $row)
 {
  return $row['last_activity'];
 }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $db)
{
 $query = "
 SELECT * FROM message 
 WHERE (from_user_id = '".$from_user_id."' 
 AND to_user_id = '".$to_user_id."') 
 OR (from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."') 
 ORDER BY datetime DESC
 ";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $from_user_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $db).'</b>';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["text"].'
    <div align="right">
     - <small><em>'.$row['daytime'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 $query = "
 UPDATE message 
 SET status = '0' 
 WHERE from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."' 
 AND status = '1'
 ";
 $statement = $db->prepare($query);
 $statement->execute();
 return $output;
}

function get_user_name($user_id, $db)
{
 $query = "SELECT name FROM user WHERE id = '$userid'";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['username'];
 }
}

function count_unseen_message($from_user_id, $to_user_id, $db)
{
 $query = "
 SELECT * FROM message 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
 $statement = $db->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}

function fetch_is_type_status($userid, $db)
{
 $query = "
 SELECT is_type FROM login_details 
 WHERE user_id = '".$userid."' 
 ORDER BY last_activity DESC 
 LIMIT 1
 "; 
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row)
 {
  if($row["is_type"] == 'yes')
  {
   $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
  }
 }
 return $output;
}
function countMessage() {
	$query = "SELECT count(from_user_id) as c FROM message";
	global $db;
	$results = mysqli_query( $db, $query );
	$row = mysqli_fetch_assoc( $results );
	if ( !$results || $row ) {
		return $row[ "c" ];
	} else {
		return 0;
	}

}

function countGuitar() {
$query = "SELECT DISTINCT(title) as c FROM guitar, likes WHERE likes.guitar_id = guitar.id ORDER BY guitar.title";
	global $db;
	$results = mysqli_query( $db, $query );
	$row = mysqli_fetch_assoc( $results );
	if ( !$results || $row ) {
		return $row[ "c" ];
	} else {
		return 0;
	}

}


function countPopularDay() {
	$query = "SELECT DAYNAME(datetime) as c FROM message";
	global $db;
	$results = mysqli_query( $db, $query );

	
	$row = mysqli_fetch_assoc( $results );

	
	if ( !$results || $row ) {
		return $row[ "c" ];
		
	} else {
		return 0;
	
	}

}

function countLikedGuitar() {
	$query = "SELECT  title as c FROM guitar WHERE id IN( SELECT guitar_id from likes where user_id= '".$_SESSION['userid']."')";
	global $db;
	$results = mysqli_query( $db, $query );
	$row = mysqli_fetch_assoc( $results );
	if ( !$results || $row ) {
		return $row[ "c" ];
	} else {
		return 0;
	}
	$temp = array();

}
function get_hash($pass) {
    $bytes = openssl_random_pseudo_bytes(30);
    $random_data = substr(base64_encode($bytes), 0, 22);
    $random_data = strtr($random_data, '+', '.');

    $local_salt = "$2y$12$" . $random_data;
return crypt($pass, $local_salt);    

	for($i = 0; $i < 10; $i++)
		{
    $hash = get_hash($password);
	

    //echo $hash;
    //echo '<br>';
		}
		}

	
	







?>