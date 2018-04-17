
<!DOCTYPE html>
<html lang="en">
    <body>
        <form action="includes/logout.php" method="post">
            <input type="submit" name="logout" value="LOGOUT" />
        </form>
    <?php
    include ('includes/header.php');
    ?>
		<div class="nav">
            <?php
            include ('includes/menu.php');
            ?>
		</div>
<?php
function arrayKey ($array){
    reset($array);
    $arrayKey=key($array);
    return $arrayKey;
}
//this simple function will get just the key from an array formed of key and value. as we use it after the check function this function will check if the key is pass (that's mean that the value entred match the requirements) or error
        
function checkTxt ($data){
    $errors = array('error' => '');
    $clean = array();
    $pass = false;
    //create empty arrays and boolean
    if(!empty($data)){
        if(strlen($data)>30){
            $errors['error'] = 'name/surname too long';
        }else{
            if(ctype_alpha($data) == false){
                $errors['error'] = 'name/surname must contain only letters';
            }else{
                if (preg_match('/[^a-zA-Z\d]/',$data)) {
                $errors['error'] = 'No special characters allowed on name/surname';
                }else{
                    $clean['pass'] = $data;
                    $pass = true;
                }
            }
            // a set of requirments that if not right will set the input as an error and not save the data
            // if the requirments are fullified will set the value as pass and carry on with the form
        }
    }if ($pass == true) {
        return $clean;
    }else {
        return $errors;
    }
}

function checkUserName ($username){
    $errors = array('error' => 'No username entred');
    $clean = array();
    $pass = false;
    //create empty arrays and boolean
    if($username != ''){
        if(strlen($username)<6){
            $errors['error'] = 'username not long enough';
        }else{
            if (preg_match('/[^a-zA-Z\d]/',$username)) {
                $errors['error'] = 'No special characters allowed on username';
            }else{
                $clean['pass'] = $username;
                $pass = true;
            }
            // a set of requirments that if not right will set the input as an error and not save the data
            // if the requirments are fullified will set the value as pass and carry on with the form
        }
    }if ($pass == true) {
        return $clean;
    }else {
        return $errors;
    }
}
    
function checkPassword ($password){
    $trimPass = trim($password);
    $errorsPass = array('error' => 'No password entred');
    $clean = array();
    $pass = false;
    //create empty arrays and boolean
    if(!empty($trimPass)){
        if(strlen($trimPass)<6){
            $errorsPass['error'] = 'password not long enough';
        }else{
            if (preg_match('/[^a-zA-Z\d]/',$trimPass)) {
                $errorsPass['error'] = 'No special characters allowed on password';
            }else{
                $clean['pass'] = $password;
                $pass = true;
            }
            // a set of requirments that if not right will set the input as an error and not save the data
            // if the requirments are fullified will set the value as pass and carry on with the form
        }
    }if ($pass == true) {
        return $clean;
    }else {
        return $errorsPass;
    }
}

$output = '';
$errmsg = '';

$form_is_submitted = false;
$errors_detected = false;

$cleanArray = array();
$errorsArray = array();
$dataArray = array();
//create empty arrays and variable,and boolean

if(isset($_POST['SUBmit'])){
    $form_is_submitted = true;
    if (isset($_POST['title'])){
        $cleanArray['title'] = $_POST['title'];
    }
    //check that the title is input and save it in the clean array
    
    if (isset($_POST['fname']) && !empty($_POST['fname'])) {
        $fname = $_POST['fname'];
        $trimFn = trim($fname);
        //if the fname filed is sett and not empty save the input in a variable and trim the empty spaces
        $lowerFn = strtolower($trimFn);
        $dataArray = checkTxt($lowerFn);
        $keyData = arrayKey($dataArray);
        //make the input on lower case and first check with the check function that the requirments are fullified and then check if the return key from the check function is error or pass
        if ($keyData == 'pass'){
            $cleanArray['fname'] = $dataArray[$keyData];
        }else{
            $errorsArray['fname'] = $dataArray[$keyData];
            $errors_detected = true;
        }
        //if the return key value from the check function is pass save the input in the clean array as fname 
        //else save it in the error array as fname with the message error that the check function produced
    }else{
        $errorsArray['fname'] = 'No name/surname entred';
        $errors_detected = true;
        //if the input is an empty value save the empty value message in teh error array
    }
    $dataArray = array();
    
    if (isset($_POST['lname']) && !empty($_POST['lname'])) {
        $lname = $_POST['lname'];
        $trimLn = trim($lname);
        //if the fname filed is sett and not empty save the input in a variable and trim the empty spaces
        $lowerLn = strtolower($trimLn);
        $dataArray = checkTxt($lowerLn);
        $keyData = arrayKey($dataArray);
        //make the input on lower case and first check with the check function that the requirments are fullified and then check if the return key from the check function is error or pass
        if ($keyData == 'pass'){
            $cleanArray['lname'] = $dataArray[$keyData];
        }else{
            $errorsArray['lname'] = $dataArray[$keyData];
            $errors_detected = true;
        }
        //if the return key value from the check function is pass save the input in the clean array as lname 
        //else save it in the error array as fname with the message error that the check function produced
    }else{
        $errorsArray['lname'] = 'No name/surname entred';
        $errors_detected = true;
        //if the input is an empty value save the empty value message in teh error array
    }
    $dataArray = array();
    
    if (isset($_POST['email'])) {
        if (empty($_POST['email'])){
            $errors_detected = true;
            $errorsArray['email'] = 'Email not entered';
            //if the input is an empty value save the empty value message in teh error array
        }else {
            $emailGet = $_POST['email'];
            $emailTrim = trim($emailGet);
            if (!filter_var($emailTrim, FILTER_VALIDATE_EMAIL)){
                $errorsArray['email'] = 'Invalid email format';
                $errors_detected = true;
                //trim the email from empty spaces and check filter validate email that the input follow the regulamentation
            }else{
                $cleanArray['email'] = $emailTrim;
            }
        }
    }
    
    if (isset($_POST['userNm']) && !empty($_POST['userNm'])) {
        $username = $_POST['userNm'];
        $trimUsnm = trim($username);
        //if the fname filed is sett and not empty save the input in a variable and trim the empty spaces
        $lowerUsnm = strtolower($trimUsnm);
        $dataArray = checkUserName($lowerUsnm);
        $keyData = arrayKey($dataArray);
        //make the input on lower case and first check with the check function that the requirments are fullified and then check if the return key from the check function is error or pass
        if ($keyData == 'pass'){
            $cleanArray['userNm'] = $dataArray[$keyData];
        }else{
            $errorsArray['userNm'] = $dataArray[$keyData];
            $errors_detected = true;
        }
        //if the return key value from the check function is pass save the input in the clean array as userNm 
        //else save it in the error array as fname with the message error that the check function produced
    }else{
        $errorsArray['userNm'] = 'username not entered';
        $errors_detected = true;
        //if the input is an empty value save the empty value message in teh error array
    }
    $dataArray = array();
    
    if (isset($_POST['psWord']) && !empty($_POST['psWord'])) {
        $password = $_POST['psWord'];
        $trimPass = trim($password);
        //if the fname filed is sett and not empty save the input in a variable and trim the empty spaces
        $dataArray = checkPassword($trimPass);
        $keyData = arrayKey($dataArray);
        //mfirst check with the check function that the requirments are fullified and then check if the return key from the check function is error or pass
        if ($keyData == 'pass'){
            $cleanArray['psWord'] = $dataArray[$keyData];
        }else{
            $errorsArray['psWord'] = $dataArray[$keyData];
            $errors_detected = true;
        }
        //if the return key value from the check function is pass save the input in the clean array as userNm 
        //else save it in the error array as fname with the message error that the check function produced
    }else{
        $errorsArray['psWord'] = 'password not entered';
        $errors_detected = true;
        //if the input is an empty value save the empty value message in teh error array
    }
}

if($form_is_submitted == true && $errors_detected == false){
    //if the form is submitted and the error array is empty
    $dir = '/home/sbau01/public_www/php/fma/data';
    if (is_dir($dir)){
        $handleDir = opendir('/home/sbau01/public_www/php/fma/data');
        //find directory and open it
        while(false !==($file = readdir($handleDir))){
            $path = "/home/sbau01/public_www/php/fma/data/".$file;
            if(is_file($path)){
				$handle =  fopen($path, 'a');
                //open the data.txt file and prepare it to append the data from the form
				$text = $cleanArray['fname'].' '.$cleanArray['lname'].' '.$cleanArray['email'].' '.$cleanArray['userNm'].' '.$cleanArray['psWord']. PHP_EOL;
				$result = fwrite($handle, $text);
                //create the string that you will append to the data file and put a speace so will be easy to explode later
                //write he string in the data.txt file
				if($result == false){
				    $errmsg = '<p>Oops! data not written</p>';
				}
				else{
                    $fullName = htmlentities($cleanArray['title']).' ' .htmlentities($cleanArray['fname']).' '.htmlentities($cleanArray['lname']);
				    $errmsg = '<p>Thank you for register ' .$fullName. ' with us. We send an email to '.htmlentities($cleanArray['email']).' with his/her username: '.htmlentities($cleanArray['userNm']).' and password: '.htmlentities($cleanArray['psWord']).'. Always remember to take note of the registration details in case of lost. The details has been saved. </p>';
				}
                //if the program fail to append the data an error message will show
                //else a message whit all the data written will be shown so you will be able to check if the data is right and you can take not of username and password
				fclose($handle);
            }
            else{
				$errmsg= '<p>Oops!!! file  has not been found >>>  '.$path.'</p>';
            }
        }closedir($handleDir);
        $output= '<p>Registration form has been submitted</p>';
    }else{
       $errmsg = '<p>Oops, the file has NOT been found!!!</p>'; 
    }
    // a series of simple error or positive message if directory or data.txt file are not found and positive if the append of the data is succsefull
}
else{
    $self = htmlentities($_SERVER['PHP_SELF']);
    if($form_is_submitted == true){
        //if form submitted is true but error array not empty
        foreach((array)$errorsArray as $err){
            $errmsg .= $err.'<br />';	
            //for each error in the array 
        }	
    }
    //in case that the error array is not empty the form will be shown again with a series of error message at the bottom
    
    $output = '<form action="'.$self.'" method="post">
        <fieldset>
            <legend>Details:</legend>
                <label for="tl">Title:</label>
                    <select name="title">
                        <option value="Mr">Mr.</option>
                        <option value="Miss">Miss</option>
                        <option value="Mrs">Mrs.</option>
                    </select>
                <div>
                    <label for="fn">First Name:</label>
                    <input type="text" name="fname" id="fn" value="" />
                </div>
                <div>
                    <label for="ln">Surame:</label>
                    <input type="text" name="lname" id="ln" value="" />
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" value="" />
                </div>
                <div>
                    <label for="un">Username:</label>
                    <input type="text" name="userNm" id="un" value="" />
                </div>
                <div>
                    <label for="pw">Password:</label>
                    <input type="password" name="psWord" id="pw" value=""/>
                </div>
                <input type="submit" name="SUBmit" value="SUBMIT" />
        </fieldset>
    </form>';
}
$newUser = array ($cleanArray, $errorsArray);
echo $output;
echo $errmsg;
        //if error array is empty the simple form will be shown if not the form will be output empty with a series of errors message at the bottom
        

?>
        <footer>
            <?php include ('includes/footer.php');?>
        </footer>
    </body>
</html>