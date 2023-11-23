<?php

include("functions.php");


if(isset($_REQUEST['logout'])){
    $_SESSION['message_from'] = null;
    $_SESSION['message_to'] = null;
    session_destroy();

    echo '<div class="text-box">
        <script> window.location = "../index.php?logout=successfull"</script>
    </div>';
}

?>
