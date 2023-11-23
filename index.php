<?php


include("assets/functions.php");
include("includes/header.php"); 

if(isset($_GET["admin"])){
    $admin = "true";
    $_SESSION['msg_from'] = "admin@gmail.com";
}else{
    $admin = false;
    $_SESSION['msg_to'] = "admin@gmail.com";
}
$_SESSION['admin'] = $admin;

if(isset($_GET['login']) && $_GET['login'] == "error"){
    $error = "please login ";
}

$email = "";
if(isset($_POST['login'])){

    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);    
    $msg_to_email = $_POST['msg_to'];


    if($email === $msg_to_email){
        $error .= "<p>please choose someone else to chat with...</p>";
    }
    if($error == ""){
        $data = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password';";
        $result = mysqli_query($db_conn, $data);
        $row = mysqli_num_rows($result);

        if($row !== 1){
            $error .=  "</br><p>Login Error: incorrect email or password</p>";
        }
        if($row == 1){
            // echo "Login Sucessfull";

            $_SESSION['msg_from'] =    $email;
            $_SESSION['msg_to'] =  $msg_to_email;
            $_SESSION['login'] =  "true";

            echo '<div class="text-box">
                    <script> window.location = "chat.php?welcome='.$email.'&chating='.$msg_to_email.'"</script>
                </div>';
        }
    }

}

?>


<div class="container">

    <form action="index.php" method="post">
    <div class="form-content">
        <h2 class="center">LOGIN TO CHAT APP</h2>
        <!-- DISPLAY ERROR -->
        <div class="red center">
            <?php echo $error;?>
        </div>
        <div class="form-data">
            <label for="email">Email:</label><br>
            <input type="text" name="email"  placeholder="Enter your email" value="<?php echo $email; ?>" id="email" required>
        </div>
        <div class="form-data">
            <label for="email">password:</label><br>
            <input type="password" name="password"  placeholder="Enter your password" id="password" required>
        </div>
        <div class="form-data" id="select-reciever">
            <label for="to">Group Members:</label><br>
            <select name="msg_to" id="to" value="">

            <!-- Chech if the user is admin -->
                <?php if($admin){?>
                    <?php echo msg_to_option("admin@gmail.com"); ?>
                <?php }else{?>
                    <option value="admin@gmail.com">Customer Care</option>
                    <option value="admin@gmail.com">Surport</option>
                <?php }?>

            </select><br>
            <button type="submit" name="login" id="btn">Start Chat</button>
        </div>

    </div>
    </form>

</div>


<?php

include("includes/footer.php");


?>