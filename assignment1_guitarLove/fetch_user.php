<?php

//fetch_user.php

include('server.php');
$query = "
SELECT user_id FROM login_details 
WHERE user_id != '".$_SESSION['userid']."' 
";
//$statement = $db->prepare($query);

//$statement->execute();


//$results =$statement->fetchAll();
$results = mysqli_query( $db, $query );

						
$output = '
<table class="table table-bordered table-striped">
 <tr>
  <th width="70%">Username</td>
  <th width="20%">Status</td>
  <th width="10%">Action</td>
 </tr>
';

echo "checkpoint1";
foreach($results as $row)
{

 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['user_id'], $db);
 
 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="label label-success">Online</span>';
 }
 else
 {
  $status = '<span class="label label-danger">Offline</span>';
 }
 $output .= '
 <tr>
  <td> '.count_unseen_message($row['from_user_id'], $_SESSION['user_id'], $db).' '.fetch_is_type_status($row['to_user_id'], $db).'</td>
  <td>'.$status.'</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
 </tr>
 ';
 echo "checkpoint5";
}

$output .= '</table>';

echo $output;

?>
