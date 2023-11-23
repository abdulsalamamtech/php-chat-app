<?php
// THE PHP FUNCTION FILE
include("assets/functions.php");
// THE HEADER
include("includes/header.php");

// CHECK LOGIN ACCESS
check_login_access();

// CHECK ADMIN
$admin = $_SESSION['admin'];

// REDIRECT USER BACK TO INDEX PAGE IF NOT LOGIN
if($_SESSION['login'] !==  "true"){

    echo '<div class="text-box">
            <script> window.location = "index.php?login=error"</script>
        </div>';
}


?>

<!-- CSS STYLE -->
<style>
    .green{
        color: green;
    }
    .red{
        color: red;
    }
</style>



<!-- START OF CHAT CONTAINER -->
<div class="container">

    <!-- HERO -->
    <div>
        <!-- DISPLAY ERROR -->
        <div class="red center"><?php echo $error;?></div>
        
        <!-- DISPLAY ERROR -->
        <div class="green center time">
            <?=date("Y-M-d", strtotime("2023-11-22 12:10:44"))?>
        </div>

        <div class="center">
            <strong>Welcome: </strong><?php echo $_SESSION['msg_from'];?><br>
            <strong>Group members:</strong><br>
            <select name="" id="">
                <?php 
                // Chech if the user is admin
                if($admin){?>
                    <?php echo msg_to_option($_SESSION['msg_from']); ?>
                <?php }else{?>
                    <option value="admin@gmail.com">Customer Care</option>
                    <option value="admin@gmail.com">Surport</option>
                <?php }?>
            </select><br><br>
        </div>
    </div>

    <!-- LOGOUT -->
    <form action="assets/logout.php" method="post">
        <button name="logout" class="logout">LogOut</button>
    </form>

    <!-- OUTPUT MESSAGES -->
    <div id="output">
        <?php echo my_chat();?>
    </div>

    <!-- NOTIFICATION -->
    <div class="green">
        <span id="done">Your message is end to end encrypted!</span>
    </div>

    <!-- CHAT FORM -->
    <form action="chat.php" method="post" id="form" class="chat-form">

        <input type="hidden" name="msg_from" id="from" placeholder="your name" value="<?php echo $_SESSION['msg_from']; ?>">
        <input type="hidden" name="msg_to" id="to" placeholder="reciever name" value="<?php echo $_SESSION['msg_to']; ?>">

        <div class="row">
            <input type="text" name="msg_text" id="message_data" placeholder="Enter your message..." required>
            <button type="submit" id="btn" name="send_message">Send</button>
        </div>
    </form>


</div>
<!-- END OF CHAT CONTAINER -->


<!-- JQUERY -->
<script src="includes/js/jquery-1.10.2.js"></script>
<script>
$("document").ready(function(){

    // GET ALL CHAT
    allChat();
    // SCROLL TO BUTTOM OF CHAT BOX
    scrollToButtom()

    // WHEN SEND BUTTON IS CLICK
    $(".chat-form").submit(function(e){
        e.preventDefault()
        $("#done").html("processing...");

        // SEND MESSAGE TO BACKEND
        $.ajax({
            method: "POST",
            url: "assets/endpoint.php?sendmessage",
            data: {message_data: $("#message_data").val()},
            success: function(res){
                $("#message_data").val('');
                $("#done").html(res);
            },
        });

    });


    // START: GET ALL THE CHAT FROM DATABASE
    function allChat() {
        $.ajax({
            url: "assets/endpoint.php?allchat",
            success: function(res){
                // DISPLAY ALL THE CHAT INTO CHAT CONTAINER
                $("#output").html(res)
            }
        });
    }
    // END: GET ALL THE CHAT FROM DATABASE


    // START: SCROLL THE MESSAGE OUTPUT BOX TO THE BUTTOM
    function scrollToButtom(){
        var messageBody = document.querySelector ('#output');
            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
    }
    // END: SCROLL THE MESSAGE OUTPUT BOX TO THE BUTTOM



    // START: GET ALL CHAT AFTER EVERY 9 MILI SECONDS
    setInterval(() => {
        $("#done").html("you are connected");
        // GET ALL CHAT
        allChat();
        // SCROLL TO BUTTOM OF CHAT BOX
        scrollToButtom()
    }, 900);
    // END: GET ALL CHAT AFTER EVERY 9 MILI SECONDS

    

    // CHECK IF CONECTION IS ACTIVE & RETURN THE EXACT TIME.
    setInterval(() => {
        $.post("assets/endpoint.php",
        {
            data: $("#from").val(),
            to: $("#to").val()
        },
        function(data, status){
            if(status == "success"){
                $(".time").html(data);
            }
        });
    }, 1000);
        


});
</script>



<?php

// THE FOOTER
    include("includes/footer.php");

?>