<?php

    include_once __DIR__ . '\Schools.php';
    include_once __DIR__ . '\..\include\functions.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '\dbconfig.ini';
    try 
    {
        $schoolDatabase = new Schools($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    } 

    // If POST, delete the requested school before listing all schools
    $schoolListing = [];
    if (isPostRequest()) 
    {
        if (isset($_POST["Search"]))
        {
            $schoolName = "";
            $city = "";
            $state = "";
            if ($_POST["fieldName"] == "schoolName")
            {
                $schoolName = $_POST['fieldValue'];
            }
            else if ($_POST["fieldName"] == "city")
            {
                $city = $_POST['fieldValue'];
            }
            else if ($_POST["fieldName"] == "state")
            {
                $state = $_POST['fieldValue'];
            }

            //echo "schoooName: " . $schoolName . "   city: " . $city . " state: " . $state;
            $schoolListing = $schoolDatabase->getSelectedSchools($schoolName, $city, $state);
        }
        else
        {
        
            $id = filter_input(INPUT_POST, 'id');
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
    

    include_once __DIR__ . "/include/header.php";
?>

    <h2>Search Schools</h2>
    <form method="post" action="search.php">
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
                <th>School Name</th>
                <th>City</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($schoolListing as $row): ?>
            <tr>
                <td>
                    <form action="schoolSearch.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>" />
                        <button class="btn glyphicon glyphicon-trash" type="submit"></button>
                    </form>   
                </td>
                <td><?php echo $row['schoolName']; ?></td>
                <td><?php echo $row['city']; ?></td>
                <td><?php echo $row['state']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
       
    </div>
    </div>
</body>
</html>


    <?php

        include_once __DIR__ . '\..\include\footer.php';
    ?>
