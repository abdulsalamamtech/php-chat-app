<?php


include("functions.php");


// SEND CHAT TO DATABASE
if(isset($_REQUEST['sendmessage'])){
    if($_POST['message_data'] !== "" ){

        // print_r($_REQUEST);

        $msg_from_email = $_SESSION['msg_from'];
        $msg_to_email = $_SESSION['msg_to'];

        $message_text = htmlspecialchars($_POST['message_data']);
        $message_time = chat_time(time());

        $send_chat = msg_insert($msg_from_email, $msg_to_email, $message_text, $message_time);

        if($send_chat == True){

            // echo "new chat inserted";
            // $_POST['message_data'] = "";
            // $_POST['send_message'] = "";
            echo 'message sent!';
            

        }else{
            $error = "chating error";
        }
    }
}


if(isset($_REQUEST['allchat'])){
    echo my_chat();
    // echo "<br> I am from endpoint: ". random_int(0, 50); 
}


if(isset($_REQUEST['data'])){
    echo "<strong>Date & Time: </strong>" . chating_time(time());
}


?>