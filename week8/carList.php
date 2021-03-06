<?php
    include_once __DIR__ . '/include/functions.php'; 
    // Load helper functions (which also starts the session) then check if user is logged in
    
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
    // If POST, delete the requested car before listing all
    $carList = [];
    if (isPostRequest()) 
    {
        if (isset($_POST["Search"]))
        {
            $carYear ="";
            $carMake="";
            $carModel="";
            $carTrans = "";
            $carColor = "";
            $carPurchase="";

            if ($_POST["fieldName"] == "carYear")
            {
                $carYear = $_POST['fieldValue'];
            }
            if ($_POST["fieldName"] == "carMake")
            {
                $carMake = $_POST['fieldValue'];
            }
            else if ($_POST["fieldName"] == "carModel")
            {
                $carModel = $_POST['fieldValue'];
            }
            if ($_POST["fieldName"] == "carTrans")
            {
                $carTrans = $_POST['fieldValue'];
            }
            if ($_POST["fieldName"] == "carColor")
            {
                $carColor = $_POST['fieldValue'];
            }
            else if ($_POST["fieldName"] == "carPurchase")
            {
                $carPurchase = $_POST['fieldValue'];
            }

            $carList = $carDatabase->searchCars($carYear, $carMake, $carModel, $carTrans, $carColor, $carPurchase);
        }
        else
        {
        
            $id = filter_input(INPUT_POST, 'carId');
            $carDatabase->deleteCar($id);
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
    $carYear = array_column($carList, 'carYear');
    $carMake  = array_column($carList, 'carMake');
    $carModel = array_column($carList, 'carModel');
    $carTrans = array_column($carList, 'carTrans');
    $carColor = array_column($carList, 'carColor');
    $carPurchase = array_column($carList, 'carPurchase');

    array_multisort($carMake, SORT_ASC, $carMake, SORT_ASC, $carList);

// Load HTML page header
    include_once __DIR__ . "/include/header.php";

?>
    <h2>Search Cars</h2>
  <form action="#" method="post">
      <input type="hidden" name="action" value="search" />
      <label>Search by Field:</label>
       <select name="fieldName">
              <option value="">Select One</option>
              <option value="carYear">Year</option>
              <option value="carMake">Make</option>
              <option value="carModel">Model</option>
              <option value="carTrans">Transmission</option>
              <option value="carColor">Color</option>
          </select>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>     
  </form>      

    <div class="col-sm-offset-2 col-sm-10">
        <h1>Cars</h1>
        <br />
        <!--Removed links-->     
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Delete</th>
                <th>Year</th>
                <th>Make</th>
                <th>Model</th>
                <th>Transmission</th>
                <th>Color</th>
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
                    </form>   
                </td>
                <td><?php echo $row['carYear'];?></td>
                <td><?php echo $row['carMake']; ?></td>
                <td><?php echo $row['carModel']; ?></td>
                <td><?php echo $row['carTrans']; ?></td>
                <td><?php echo $row['carColor']; ?></td>
                <td><?php echo $row['carPurchase']; ?></td>
                <td><a href="update.php?action=Update&carId=<?= $row['id'] ?>">Update</a></td> 
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
       
    </div>
    </div>
    <?php include_once __DIR__ . '/include/footer.php';?>
</body>
</html>