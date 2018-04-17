<?php
$storePass = 'DCSadmin01';
    //check if the submir button is click if yes store the password in inputPass variable
    if (isset($_POST['submit'])) {
        $inputPass = ($_POST['pass']);
        //if the input password match the stored one and the remeber me checbox will be clicked will create the session that will save the password and go to form.php if no remember me checkbox will be click it will go to from.php but when changing page you will have to login again
        if ($inputPass == $storePass) {
            if (isset($_POST['remember'])) {   
                session_start();
                $_SESSION['pass'] = $inputPass;
                header("Location: ../form.php");
            }else {
                session_start();
                header("Location: ../form.php");
            }
        }else{
        // if the input password will not match an error will be shown and a link that redirect to adminlogin will be shown
        echo "Invalid password.<br> click here to <a href = '../adminlogin.php'> try again</a>";
        }
    }

?>