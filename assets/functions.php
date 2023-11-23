<?php
// START SECTION
session_start();


// INCLUDE DATABASE CONFIGURATION
include("config.php");


// CHECK IF LOGIN
function check_login_access(){
    // if(!isset($_SESSION['msg_from']) OR empty($_SESSION['msg_from']) OR empty($_SESSION['msg_to'])){
    //     echo '<div class="text-box">
    //             <script> window.location = "index.php?error=pleaselogin"</script>
    //         </div>';
    // }
}


// CHECK FOR ERROR
$error = "";
if(isset($_GET["error"]) AND !empty($_GET["error"])){
    if($_GET["error"] == "pleaselogin"){

        $error .= "<br><p>Please Login to start chatting...</p>";
    }
}


// FORMATTED CHAT TIME
function chat_time($msg_time){
    date_default_timezone_set("Africa/Lagos");
    return $msg_time;
}

// CHATING TIME
function chating_time( $time ){
    $time = date("Y-m-d H:i:s", $time);
    return $time;
}



// $msg_from_email = $_SESSION['msg_from'];
// $msg_to_email = $_SESSION['msg_to'];
// $msg_from_email = "amalife2002@gmail.com";
// $msg_to_email = "acube@gmail.com";
// $message_text = "hello World";
// $message_time = time();
// msg_insert($msg_from_email, $msg_to_email, $message_text, $message_time);


// INSERT MESSAGE TO DATABASE
function msg_insert($msg_from_email, $msg_to_email, $message_text, $message_time){
    global $db_conn;
    $message_time =  time();

    $sql = "INSERT INTO `chats` (msg_from, msg_to, msg_text, msg_time) 
            VALUES('$msg_from_email','$msg_to_email', '$message_text', '$message_time');";
    $query = mysqli_query($db_conn, $sql);
    $result = "";
    
    if($query){
        function msg_last_id(){
            global $db_conn;
            $last_id = mysqli_insert_id($db_conn);
            return $last_id;
        }

        $result = True;
    }else{
        $result = False;
    }
    
    return $result;
}


// SELECT LAST INSERTED MESSAGE
function msg_select(){

    global $db_conn;
    $last_id = msg_last_id();

    $sql = "SELECT * FROM chats WHERE id = '{$last_id}';";
    $query = mysqli_query($db_conn, $sql);
    $result = "";

    if($query){
        $result = mysqli_fetch_assoc($query);
    }else{
        $result = False;
    }

    return $result;
}


// SELECT ALL USERS EMAIL ADDRESS
function msg_to_option($msg_from_email){

    global $db_conn;

    $sql ="SELECT * FROM `users` WHERE email != '{$msg_from_email}';";

    $query = mysqli_query($db_conn, $sql);
    // $result = "";
    if($query){

        // GET ALL USERS EMAIL
        while($data = mysqli_fetch_assoc($query)){
            $result[] = $data;
        }

    }else{
        $result = False;
    }
    
    $select_option = "";
    for ($i=0; $i < count($result); $i++) { 
        # code...
        if(isset($_SESSION['msg_from'])){
            $active = ($result[$i]['email'] == $_SESSION['msg_from'] )? " >>> You're Active" : "";
        }
        $select_option .=  '<option value="'.$result[$i]['email'].'">'.$result[$i]['email'] . $active.'</option>';
    }
    // $result_option =  "<select name='msg_to'>". $select_option ."</select>";
    // return $result_option;

    return $select_option;
}


// SELECT USERS ON CHAT BY THEIR EMAIL ADDRESS
function msg_by_email(){

    global $db_conn;
    $msg_from_email= $_SESSION['msg_from'];
    $msg_to_email =  $_SESSION['msg_to'];

    // $sql = "SELECT * FROM `chats` ORDER BY `id`;";

    $sql = "SELECT * FROM `chats` WHERE 
        (`msg_from` = '$msg_from_email' OR 
        `msg_to` = '$msg_from_email') AND 
        (`msg_from` = '$msg_to_email' OR 
        `msg_to` = '$msg_to_email')
        ORDER BY id";

    // $sql = "SELECT * FROM `chat_app_ajax` WHERE (`msg_from_email` = '{$msg_from_email}' 
    //         AND `msg_to_email` = '{$msg_to_email}') 
    //         OR (`msg_from_email` = '{$msg_to_email}' 
    //         AND `msg_to_email` = '{$msg_from_email}') 
    //         ORDER BY `id`;";

    $query = mysqli_query($db_conn, $sql);
    $result = array();

    if($query){
        while($chat = mysqli_fetch_assoc($query)){
            $result[] = $chat;
        }
    }else{
        $result = False;
    }

    return $result;
}


// DISPLAY CHAT ON CHAT PAGE
function my_chat(){

        $my_chat = msg_by_email();

        $text = "<div class='chat-container'>";
        for ($i=0; $i < count($my_chat); $i++) { 

            $all_chat = $my_chat[$i];
            if($all_chat["msg_from"]  == $_SESSION['msg_from']){
                $css_name = "chat-message-from";
                $pronoun = "Me: ";
            }else{
                $css_name = "chat-message";
                $pronoun = "From: ";
            }



                $text .= "<div class='{$css_name}'>";
                $text .= "<h3>{$pronoun}<small>".$all_chat["msg_from"]."</small></h3>"; 
                $text .= "<p class='chat-text'>".$all_chat["msg_text"] . "</p>";
                $text .= "<small>" . date("Y M D, h:i:s a", strtotime($all_chat["msg_time"])). "</small><br>";
                $text .= "</div>";
        }
        $text .= "</div>";

        return $text;
}


// echo "<pre>";
// print_r(msg_by_email($msg_from_email, $msg_to_email));
// print_r(msg_to_option("amalife2002@gmail.com"));
// echo "<pre>";


// $text = dirname(__DIR__) . "/includes/css/style.css";
// $text = file_get_contents($text);


// msg_to_option("amalife2002@gmail.com");
?>