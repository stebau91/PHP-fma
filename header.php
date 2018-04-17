<?php    
    
if (stripos($_SERVER['REQUEST_URI'], 'index.php' )){
     echo "<li><a href='adminlogin.php'>Administrator</a></li>
           <li><a href='intranetlogin.php'>Intranet for members</a></li>";
}

?>