<?php

   

    //including schools that houses functions and functions for more widely used functions
    include_once __DIR__ . '\model\Schools.php';
    include_once __DIR__ . '\include\functions.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '\model\dbconfig.ini';

    try 
    {
        $schoolDatabase = new Schools($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    } 

    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

    //adding schoolListing as an array to store the schools into a table
    // If POST, delete the requested school before listing all schools
    //variable names go before the isPostRequest so that the html can use it below and access those variables
    $schoolName = "";
    $city = "";
    $state = "";
    if (isPostRequest()) 
    {
        //echo 'post request';
        $schoolListing = [];
        //if were searching than we are going to look at the names as defined in the form and place then in the correct columns

        if (isset($_POST["search"]))
        {
            //echo 'here';
            
            //on the post schoolName, city, state search the database and retrun the schools fitting the parameters
            if ($_POST["schoolName"])
            {
                //echo 'here2';
                $schoolName = $_POST['schoolName'];
            }
            elseif ($_POST["city"])
            {
                $city = $_POST['city'];
            }
            elseif ($_POST["state"])
            {
                $state = $_POST['state'];
            }

            $schoolListing = $schoolDatabase->getSelectedSchools($schoolName, $city, $state);
        }
        else
        {
        
            $id = filter_input(INPUT_POST, 'id');
            $schoolDatabase->deleteAllSchools($id);
            $schoolListing = $schoolDatabase->getSelectedSchools($schoolName, $city, $state);
        }
    }
    else
    {
        $schoolListing = $schoolDatabase->getSelectedSchools($schoolName, $city, $state);
    }

        //*******************************************************************//
        //************     TODO     *****************************************//
        //
        // Create an object to represent the schools table in the database 
        //
        //  Add your search logic here. 
        // 
        // Call getSchools with the appropriate arguments
        //
        //*******************************************************************//
    

    include_once __DIR__ . '\include\header.php';
?>

    <h2>Search Schools</h2>
    <form method="post" action="schoolSearch.php">
        <div class="rowContainer">
            <div class="col1">School Name:</div>
            <div class="col2"><input type="text" name="schoolName" value="<?php echo $schoolName; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">City:</div>
            <div class="col2"><input type="text" name="city" value="<?php echo $city; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">State:</div>
            <div class="col2"><input type="text" name="state" value="<?php echo $state; ?>"></div> 
        </div>
            <div class="rowContainer">
            <div class="col1">&nbsp;</div>
            <div class="col2"><input type="submit" name="search" value="Search" class="btn btn-warning"></div> 
        </div>
    </form>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>School Name</th>
                <th>City</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
      
            <?php foreach ($schoolListing as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['schoolName']; ?></td>
                    <td><?php echo $row['schoolCity']; ?></td>
                    <td><?php echo $row['schoolState']; ?></td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>


<?php

    include_once __DIR__ . '\include\footer.php';
?>
