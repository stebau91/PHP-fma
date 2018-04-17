<?php
//check that the logout button is click
if(isset($_POST['logout'])){
    //start new session
    session_start();
    //delate information about 'pass' session and echo the message to login again in adminlogin page
    unset($_SESSION["pass"]); 
    echo "You successfully logout. clicke here to <a href = '../adminlogin.php'> login again</a>";
}
?>