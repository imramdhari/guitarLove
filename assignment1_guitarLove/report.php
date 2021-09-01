<?php
include('server.php');
  $userid = $_SESSION[ "userid" ];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>List of users</title>
    </head>
    <body>
    	<div class="header">
        	<?php include("header.php"); ?>
	    </div>
        <div class="content">
This is the list of members:
<table>
    <tr>
    	<th>Id</th>
    	<th>Username</th>
    	<th>Email</th>
    </tr>
<?php
//We get the IDs, usernames and emails of users
$query = "select id, name, email from user where id!='" . $userid . "'";
$results = mysqli_query( $db, $query );
if ( $row = mysqli_fetch_assoc($results ) ) {
	$userid = $row[ "id" ];
	$useremail = $row[ "email" ];
	$username = $row[ "name" ];
	

}

?>
	<tr>
    	<td class="left"><?php echo $row['id']; ?></td>
    	<td class="left"><?php echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td class="left"><?php echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>
</table>
		</div>
		
	</body>
</html>

<?php include ("footer.php");  ?>