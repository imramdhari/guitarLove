<?php

//fetch_user_chat_history.php

include('server.php');

session_start();

echo fetch_user_chat_history($_SESSION['userid'], $_POST['to_user_id'], $db);

?>