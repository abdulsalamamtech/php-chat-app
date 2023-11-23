<?php

    // AFRICA/LAGOS
    date_default_timezone_set("Africa/Lagos");


$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "chat_app";

$db_conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if(!$db_conn){
    echo "We are sorry: Server error, try again later";
}


?>