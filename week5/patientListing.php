<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/include/functions.php'; 
    //if (!isUserLoggedIn())
    //{
    //    header ('Location: login.php');
    //}

   include_once __DIR__ . '/model/Search.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/model/dbconfig.ini';
    try 
    {
        $patientDatabase = new PatientSearch($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested team before listing all teams
    $patientListing = [];
    if (isPostRequest()) 
    {
        if (isset($_POST["Search"]))
        {
            $patientFirstName="";
            $patientLastName="";
            $patientMarried="";
            if ($_POST["fieldName"] == "patientFirstName")
            {
                $patientFirstName = $_POST['fieldValue'];
            }
            else if ($_POST["fieldName"] == "patientLastName")
            {
                $patientLastName = $_POST['fieldValue'];
            }
            else if ($_POST["fieldName"] == "patientMarried")
            {
                $patientMarried = $_POST['fieldValue'];
            }

            //echo "patientFirstName: " . $patientFirstName . "   patientLastName: " . $patientLastName . " patientMarried: " . $patientMarried . " patientBirthDate: " . $patientBirthDate;
            $patientListing = $patientDatabase->searchPatients($patientFirstName, $patientLastName, $patientMarried);
        }
        else
        {
        
            $id = filter_input(INPUT_POST, 'patientId');
            $patientDatabase->deletePatient ($id);
            $patientListing = $patientDatabase->getPatients();
        }
    }
    else
    {
        $patientListing = $patientDatabase->getPatients();
    }


    // This is a quick sorting hack that does not use
    // either the page form or a database query.
    // It sorts based on the associative array keys.
    $patientFirstName  = array_column($patientListing, 'patientFirstName');
    $patientLastName = array_column($patientListing, 'patientLastName');
    $patientMarried = array_column($patientListing, 'patientMarried');
    $patientBirthDate = array_column($patientListing, 'patientBirthDate');

    array_multisort($patientLastName, SORT_ASC, $patientLastName, SORT_ASC, $patientListing);

// Preliminaries are done, load HTML page header
    include_once __DIR__ . "/include/header.php";

?>
    <h2>Search for a Patient</h2>
  <form action="#" method="post">
      <input type="hidden" name="action" value="search" />
      <label>Search by Field:</label>
       <select name="fieldName">
              <option value="">Select One</option>
              <option value="patientFirstName">First Name</option>
              <option value="patientLastName">Last Name</option>
              <option value="patientMarried">Marital Status</option>
          </select>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>     
  </form>      
  <!-- <div style="background-color: #fff0cc; padding: 10px;">

  <h2>Sort Patients [<em>not implemented</em>]</h2>
<form  action="#" method="post">
    <input type="hidden" name="action" value="sort">
       <label>Sort By Field:&nbsp;&nbsp;&nbsp;</label>
       <select name="fieldName">
              <option value="">Select One</option>
              <option value="patientFirstName">First Name</option>
              <option value="patientLastName">Last Name</option>
              <option value="patientMarried">Marital Status</option>
              <option value="patientBirthDate">Birth Date</option>
              
          </select>
       <input type="radio" name="fieldValue" value="ASC" checked />Ascending
       <input type="radio" name="fieldValue" value="DESC" />Descending
       
      <button type="submit"  name="sortPatient">Sort</button>
</form>  
</div> -->
    <div class="col-sm-offset-2 col-sm-10">
        <h1>Patients</h1>
        <br />
        <a href="updatePatient.php?action=Add">Add New Patient</a>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Marital Status</th>
                <th>Birth Date</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($patientListing as $row): ?>
            <tr>
                <td>
                    <form action="patientListing.php" method="post">
                        <input type="hidden" name="patientId" value="<?= $row['id']; ?>" />
                        <button class="btn glyphicon glyphicon-trash" type="submit"></button>
                        <?php echo $row['id']; ?>
                    </form>   
                </td>
                <td><?php echo $row['patientFirstName']; ?></td>
                <td><?php echo $row['patientLastName']; ?></td>
                <td><?php echo $row['patientMarried']; ?></td>
                <td><?php echo $row['patientBirthDate']; ?></td>
                <td><a href="updatePatient.php?action=Update&patientId=<?= $row['id'] ?>">Update</a></td> 
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
       
    </div>
    </div>
</body>
</html>