<?php  session_start(); ?>
<?php
//it will check if the session pass is already present if yes will go strightto form.php if not will show the adminlogin page
if(isset($_SESSION['pass'])) {
    header("Location:form.php"); 
}
?>
<!DOCTYPE html>
<html lang="en">
    <body>
    <?php
    include ('includes/header.php');
    ?>
		<div class="nav">
            <?php
            include ('includes/menu.php');
            ?>
		</div>
		<section role="main">
            <div class="logIn">
                     <h3>Administrator</h3>
            </div>
            <form action="includes/validate.php" method="post">
                        <fieldset>
                            <legend>Admin Log in</legend>
                            <div>
                                <label for="password">Enter password</label>
                                <input type='password' id="pass" name="pass">
                            </div>
                            <div>
                                <laber>Remeber Me</laber>
                                <input type="checkbox" name="remember" value="1">
                            </div>
                            <div>
                                <input type="submit" name="submit" value="Log-In">
                            </div>
                        </fieldset>
            </form>
        </section>
        <footer>
            <?php include ('includes/footer.php');?>
        </footer>
    </body>
</html>
