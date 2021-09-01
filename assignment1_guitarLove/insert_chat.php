<?php

//insert_chat.php

include('server.php');

session_start();

$data = array(
 ':to_user_id'  => $_POST['to_user_id'],
 ':from_user_id'  => $_SESSION['user_id'],
 ':text'  => $_POST['text'],
 ':status'   => '1'
);

$query = "
INSERT INTO message 
(to_user_id, from_user_id, text, status) 
VALUES (:to_user_id, :from_user_id, :text, :status)
";

$statement = $db->prepare($query);

if($statement->execute($data))
{
 echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $db);
}

?>