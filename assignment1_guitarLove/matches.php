<?php
include_once( "startagain.php" );
include_once( "server.php" );

$userid = $_SESSION[ "userid" ];

$names;


$query1 = "SELECT  DISTINCT(user_id) FROM likes WHERE guitar_id NOT IN( SELECT guitar_id from likes where user_id= " . $userid . ")";

global $db;
$results1 = mysqli_query( $db, $query1 );
$rows = mysqli_fetch_all( $results1 );
$recommendedUser = array();
foreach($rows as $temp) {
  array_push($recommendedUser, $temp[0]);
}
	include_once( "header.php" );
?>

 <link rel="stylesheet" type="text/css" href="css/style.css">

<div class="breadcrumbs">
	<
				<h1>
					<?php 
					if (isset($_GET["status"])) {
						//var_dump($_GET);
						echo $_GET["status"];
					}
//
//					if (isset($_POST[ "submit" ])) {
//						echo var_dump($names[0]);
//					}
					?>
				</h1>
		
	
	</div>
	<div class="col-sm-8">


<div class="breadcrumbs">
	
			<div class="page-title">
				<h1>
					Potential Matches
				</h1>
			



			</div>
		
</div>
<div class="content mt-3">
	<?php
	foreach ( $recommendedUser as $pmatch ) {
		global $db;
		$query = "SELECT * FROM user WHERE id = " . $pmatch;
		$results = mysqli_query( $db, $query );
		
		while ( $row = mysqli_fetch_assoc( $results ) ) {
			?>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<strong>
					<?php echo $row["name"]; ?>
				</strong>
			</div>
			<div class="card-body card-block">

				<div class="form-group">
					<label for='street' class=' form-control-label'>ID</label>
					<input type="text" id="vat" value='<?php echo $row["id"]; ?>' class="form-control col-lg-12" readonly>
					</br>
					<label for="vat" class=" form-control-label">Favourite Guitar</label>
					<input type="text" id="vat" placeholder="NA" value='<?php echo implode(", ", getCurrentUserTags($pmatch)); ?>' class="form-control col-lg-12" readonly>
					<br>
					
                    <section position =center >    
                                               
                                            <li><a href="message.php"><span>Click Here To Send Message</span></a></li>
                                                  
                                                        
                           </ul>
                                  </nav>
					

				</div>
			</div>
		</div>

	</div>




	<?php
	}
	}


	?>
</div>

<?php include( "footer.php" ); ?>