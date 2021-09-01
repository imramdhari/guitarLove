<?php

include( "server.php" );
include ("header.php");

?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>
					<?php 
					if (isset($_GET["status"])) {
						//var_dump($_GET);
						echo $_GET["status"];
					}
					?>
				</h1>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="col-sm-12">
		<div class="alert  alert-success alert-dismissible fade show" role="alert"> <span class="badge badge-pill badge-success">Hello</span> Welcome to the Guitar Love Analytics.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
		</div>
	</div>

	<!--/.col-->

	
				
					<div class="stat-content dib">
						<div class="stat-text">No. of Messages Sent</div>
						<div class="stat-digit">
							<?php echo countMessage(); ?>
						</div>
					</div>
				
			
	
					<div class="stat-content dib">
						<div class="stat-text">No. of Guitar Liked</div>
						<div class="stat-digit">
							<?php echo countGuitar(); ?>
						</div>
					</div>
			
		
		
					<div class="stat-content dib">
						<div class="stat-text">Popular Day of The Week to Send Messages</div>
						<div class="stat-digit">
							<?php echo countPopularDay(); ?>
						</div>
			              </div>
	
	
				
					<div class="stat-content dib">
						<div class="stat-text">Top 3 Most-Liked</div>
						<div class="stat-digit">
							<?php echo countLikedGuitar(); ?>
						</div>
					</div>
			
			
	
	

	
	
	
	
	<?php include( "footer.php" ); ?>
		