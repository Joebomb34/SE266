<?php
    
    include_once __DIR__ . '/model/cars.php';
    include_once __DIR__ . '/include/functions.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/model/dbconfig.ini';
    try 
    {
        $carDatabase = new Cars($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested team before listing all teams
    if (isPostRequest()) {
        $id = filter_input(INPUT_POST, 'carId');
        $carDatabase->deleteCar ($id);

    }
    $carList = $carDatabase->getCars();
    
?>

<!--Creating a table for the patients to be displayed in-->

<html lang="en">
<head>
  <title>View Cars</title> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--bootstrap taken from the example...used to style the table-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        
    <div class="col-sm-offset-2 col-sm-10">
        <h1>Cars</h1>
        <br />
        <a href="update.php?action=Add">Add Car</a>  
        </br> </br>
        <a href="carList.php?action=Post">Search Cars</a>
    <table class="table table-striped">
        <thead>
            <tr>
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
                    <form action="view.php" method="post">
                        <input type="hidden" name="carId" value="<?= $row['id']; ?>" />
                        <button class="btn glyphicon glyphicon-trash" type="submit"></button>
                        <!-- <?php //echo $row['id']; ?> -->
                      
                </td>
                <td><?php echo $row['carYear']; ?></td>
                <td><?php echo $row['carMake']; ?></td>
                <td><?php echo $row['carModel']; ?></td>
                <td><?php echo $row['carTrans']; ?></td>
                <td><?php echo $row['carColor'];?></td>
                <td><?php echo $row['carPurchase']; ?></td>
                </form> 
                <td><a href="update.php?action=Update&carId=<?= $row['id'] ?>">Update</a></td> 
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
       
    </div>
    </div>
</body>
</html>