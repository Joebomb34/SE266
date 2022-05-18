 <?php
 
  // This code runs everything the page loads
  include_once __DIR__ . '/model/cars.php';
  
  // Set up configuration file and create database
  $configFile = __DIR__ . '/model/dbconfig.ini';
  try 
  {
      $carData = new Cars($configFile);
  } 
  catch ( Exception $error ) 
  {
      echo "<h2>" . $error->getMessage() . "</h2>";
  }   
   
  // If it is a GET, we are coming from view.php
  // let's figure out if we're doing update or add
  if (isset($_GET['action'])) 
  {
      $action = filter_input(INPUT_GET, 'action');
      $id = filter_input(INPUT_GET, 'carId', );
      if ($action == "Update") 
      {
          $row = $carData->getCar($id);
          $carYear = $row['carYear'];
          $carMake = $row['carMake'];
          $carModel = $row['carModel'];
          $carTrans = $row['carTrans'];
          $carColor = $row['carColor'];
          $carPurchase = $row['carPurchase'];
      } 
      //else it is Add and the user will enter patient info
      else 
      {
          $carYear = "";
          $carMake = "";
          $carModel = "";
          $carTrans = "";
          $carColor = "";
          $carPurchase = "";
      }
  } // end if GET

  // If it is a POST, we are coming from updatePatient.php
  // we need to determine action, then return to view.php
  elseif (isset($_POST['action'])) 
  {
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'carId');
      $carYear = filter_input(INPUT_POST, 'carYear');
      $carMake = filter_input(INPUT_POST, 'carMake');
      $carModel = filter_input(INPUT_POST, 'carModel');
      $carTrans = filter_input(INPUT_POST, 'carTrans');
      $carColor = filter_input(INPUT_POST, 'carColor');
      $carPurchase = filter_input(INPUT_POST, 'carPurchase');

      if ($action == "Add") 
      {
          $result = $carData->addCar ($carYear, $carMake, $carModel, $carTrans, $carColor, $carPurchase);
      } 
      elseif ($action == "Update") 
      {
          $result = $carData->updateCar ($id, $carYear, $carMake, $carModel, $carTrans, $carColor, $carPurchase);
      }

      // Redirect to view page
      header('Location: view.php');
  } // end if POST

  // If it is neither POST nor GET, we go to view.php
  // This page should not be loaded directly
  else
  {
    header('Location: view.php');  
  }
      
?>
    <!--Creating the form to be used to update or add a patient to the database-->

<html lang="en">
<head>
  <title><?= $action ?> </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--bootstrap taken from the example...used to style the table-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    
<div class="container">
  <p></p>
  <form class="form-horizontal" action="update.php" method="post">
    
  <div class="panel panel-primary">
<div class="panel-heading"><h4><?= $action; ?> Car</h4></div>
<p></p>

    <div class="form-group">
      <label class="control-label col-sm-2" for="carId">ID:</label>
      <div class="col-sm-10">
        <?= $id; ?>
        </div>
      </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="carYear">Year:</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" id="carYear" placeholder="Enter Year YYYY" name="carYear" value="<?= $carYear; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="carMake">Make:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="carMake" placeholder="Enter Make" name="carMake" value="<?= $carMake; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="carModel">Model:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="carModel" placeholder="Enter Model" name="carModel" value="<?= $carModel; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="carTrans">Transmission:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="carTrans" placeholder="Enter Transmission" name="carTrans" value="<?= $carTrans; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="carColor">Color:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="carColor" placeholder="Enter Color" name="carColor" value="<?= $carColor; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="carPurchase">Purchaase Date:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="carPurchase" placeholder="Enter Purchase Date YYYY-MM-DD" name="carPurchase" value="<?= $carPurchase; ?>">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php echo $action; ?> Car</button>
        <input type="hidden" name="action" value="<?= $action; ?>">
        
      </div>
    </div>
</div>
    <p></p>
    <!-- <div class="panel panel-warning">
    <div class="panel-heading"><strong>This is for testing and verification:</strong></div>    
        Action: <input type="text" name="action" value="<?= $action; ?>">
        Patient ID: <input type="text" name="teamId" value="<?= $id; ?>">
      </div> -->

  </form>
  
  <div class="col-sm-offset-2 col-sm-10"><a href="./view.php">View Cars</a></div>
  <div class="col-sm-offset-2 col-sm-10"><a href="./carList.php">Search Cars</a></div>
</div>
</div>

</body>
</html>