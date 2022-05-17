<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/include/functions.php'; 
    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

   include_once __DIR__ . '/model/Search.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/model/dbconfig.ini';
    try 
    {
        $carDatabase = new CarSearch($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested team before listing all teams
    $carList = [];
    if (isPostRequest()) 
    {
        if (isset($_POST["Search"]))
        {
            $carMake="";
            $carModel="";
            $carPurchase="";
            if ($_POST["fieldName"] == "carMake")
            {
                $carMake = $_POST['fieldValue'];
            }
            else if ($_POST["fieldName"] == "carModel")
            {
                $carModel = $_POST['fieldValue'];
            }
            else if ($_POST["fieldName"] == "carPurchase")
            {
                $carPurchase = $_POST['fieldValue'];
            }

            //echo "patientFirstName: " . $patientFirstName . "   patientLastName: " . $patientLastName . " patientMarried: " . $patientMarried . " patientBirthDate: " . $patientBirthDate;
            $carList = $carDatabase->searchCars($carMake, $carModel, $carPurchase);
        }
        else
        {
        
            $id = filter_input(INPUT_POST, 'carId');
            $carDatabase->deleteCar ($id);
            $carList = $carDatabase->getCars();
        }
    }
    else
    {
        $carList = $carDatabase->getCars();
    }


    // This is a quick sorting hack that does not use
    // either the page form or a database query.
    // It sorts based on the associative array keys.
    $carMake  = array_column($carList, 'carMake');
    $carModel = array_column($carList, 'carModel');
    $carPurchase = array_column($carList, 'carPurchase');

    array_multisort($carMake, SORT_ASC, $carMake, SORT_ASC, $carList);

// Preliminaries are done, load HTML page header
    include_once __DIR__ . "/include/header.php";

?>
    <h2>Search Cars</h2>
  <form action="#" method="post">
      <input type="hidden" name="action" value="search" />
      <label>Search by Field:</label>
       <select name="fieldName">
              <option value="">Select One</option>
              <option value="carMake">Car Make</option>
              <option value="carModel">Car Model</option>
              <option value="carPurchase">Purchase Date</option>
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
        <a href="update.php?action=Add">Add New Patient</a>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Purchase Date</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($carList as $row): ?>
            <tr>
                <td>
                    <form action="carList.php" method="post">
                        <input type="hidden" name="carId" value="<?= $row['id']; ?>" />
                        <button class="btn glyphicon glyphicon-trash" type="submit"></button>
                        <?php echo $row['id']; ?>
                    </form>   
                </td>
                <td><?php echo $row['carMake']; ?></td>
                <td><?php echo $row['carModel']; ?></td>
                <td><?php echo $row['carPurchase']; ?></td>
                <td><a href="update.php?action=Update&carId=<?= $row['id'] ?>">Update</a></td> 
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
       
    </div>
    </div>
</body>
</html>