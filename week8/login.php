<?php

    // Include helper utility functions
    include_once __DIR__ . '/include/functions.php';

    // Include user database definitions
    include_once __DIR__ . '/model/users.php';

    // This loads HTML header and starts our session if it has not been started
    include_once __DIR__ . "/include/header.php";

    // set logged in to false
    $_SESSION['isLoggedIn'] = false;
    
    // If this is a POST, check to see if user credentials are valid.
    // First we need to gab the crednetials form the form 
    //      and create a user database object
    $message = "";
    if (isPostRequest()) 
    {
        //echo "made it";
        // get _POST form fields
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        //echo "made it 5";
        // Set up configuration file and create database
        $configFile = __DIR__ . '/model/dbconfig.ini';
        try 
        {
            $userDatabase = new Users($configFile);
            //echo "made it 6";
        } 
        catch ( Exception $error ) 
        {
            //echo "made it 4";
            echo "<h2>" . $error->getMessage() . "</h2>";
        }   
    
        
        // Now we can check to see if use credentials are valid.
        if ($userDatabase->validateCredentials($username, $password))
        {
            //echo "made it 2";
            // If so, set logged in to TRUE
            $_SESSION['isLoggedIn'] = true;
            // Redirect to team listing page
            header ('Location: carList.php');
        } 
        else 
        {
            //echo "made it 3";
           // Whoops! Incorrect login. Tell user and stay on this page.
           $message = "You did not enter the correct login credentials.";
        }
    }

?>

<div class="container">
    <!--added a header to the page-->
    <h2>Cars</h2>
    <?php 
        if ($message)
        {   ?>
            <div style="background-color: yellow; padding: 10px; border: solid 1px black;"> 
           <?php echo $message; ?>
           </div>
        <?php } ?>

    <div id="mainDiv">
        <form method="post" action="login.php">
           
            <div class="rowContainer">
                <h3>Please Login</h3>
            </div>
            <div class="rowContainer">
                <div class="col1">User Name:</div>
                <div class="col2"><input type="text" name="username" value="donald"></div> 
            </div>
            <div class="rowContainer">
                <div class="col1">Password:</div>
                <div class="col2"><input type="password" name="password" value="duck"></div> 
            </div>
              <div class="rowContainer">
                <div class="col1">&nbsp;</div>
                <div class="col2"><input type="submit" name="login" value="Login" class="btn btn-warning"></div> 
            </div>
            
        </form>
        
    </div>

    <?php
      include_once __DIR__ . "/include/footer.php";
    ?>