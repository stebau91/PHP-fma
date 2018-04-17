<!DOCTYPE html>
<html lang="en">
    <body>
    <?php
    include ('includes/header.php');
    ?>
		<div class="nav">
            <?php
            include ('includes/menu.php');
            $error= logInData();
            ?>
		</div>
		<section role="main">
            <div class="logIn">
                     <h3>Intranet Login</h3>
            </div>
            <form action="" method="post">
                        <fieldset>
                            <legend>Student Log in</legend>
                            <div>
                                <label for="username">Enter username: </label>
                                <input type='text' id="userN" name="userN" value = "<?php if (isset($error['usern'])){echo $error['usern'];} ?>">
                            </div>
                            <div>
                                <label for="password">Enter password: </label>
                                <input type='password' id="pass" name="pass" value = "">
                            </div>
                            <div>
                                <p class="red"><?php if (isset($error['both'])) {
                                    echo $error['both'];
                                } ?></p>
                            </div>
                            <div>
                                <input type="submit" name="submit" value="Log-In">
                            </div>
                        </fieldset>
            </form>
        </section>
<?php
        
function logInData (){
    //set boolean variable
    $match = false;

    if (isset($_POST['submit'])) {
        $inputPass = ($_POST['pass']);
        $inputUsern = ($_POST['userN']);
        //if submit button is clickt save the two input on some variable
        if (empty($inputPass) && empty($inputUsern)){
            echo "empty password or username field.<br> click here to <a href = 'intranetlogin.php'> try again</a>";
            // if the two input are an empty value an error will show
        }else{
            $trimPass = trim($inputPass);
            $trimUsern = trim($inputUsern);
            //trim variable from empty spaces
            $dir = '/home/sbau01/public_www/php/fma/data';
            if (is_dir($dir)){
                $handleDir = opendir('/home/sbau01/public_www/php/fma/data');
                //find and open directory for stored username and password
                $path = "/home/sbau01/public_www/php/fma/data/data.txt";
                if(is_file($path)){
                    $handle = fopen($path, 'r');
                    //if the path is right and the directory is founded read the information inside
                    while(!feof($handle)){
                        $dataRow = fgets($handle);
                        //get the row of information saved for each student added
                        if(!empty($dataRow)){
                            $separate = explode(' ',$dataRow);
                            $storedUsern = trim($separate[3]);
                            $storedPassword = trim($separate[4]);
                            //explode the row of information so we can get just the one that we need that is the 4th and 5th (username and password) 
                            if (($trimUsern == $storedUsern) && ($trimPass == $storedPassword)) {
                                $match = true;
                                header('location: intranet.php');
                                // if the information stored match the one input go to the intranet page else display an error that the input is wrong
                            }else{
                                echo "Invalid password.<br> click here to <a href = 'intranetlogin.php'> try again</a>";
                            }
                        }
                    }fclose($handle);
                }closedir($handleDir);
                //close handle and the directory
            }
        }
    }
}
            
    
?>
        <footer>
            <?php include ('includes/footer.php');?>
        </footer>
    </body>
</html>