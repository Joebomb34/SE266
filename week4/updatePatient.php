 <?php
 
  // This code runs everything the page loads
  include_once __DIR__ . '/model/patients.php';
  
  // Set up configuration file and create database
  $configFile = __DIR__ . '/model/dbconfig.ini';
  try 
  {
      $patientDatabase = new Patients($configFile);
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
      $id = filter_input(INPUT_GET, 'patientId', );
      if ($action == "Update") 
      {
          $row = $patientDatabase->getPatient($id);
          $patientFirstName = $row['patientFirstName'];
          $patientLastName = $row['patientLastName'];
          $patientMarried = $row['patientMarried'];
          $patientBirthDate = $row['patientBirthDate'];
      } 
      //else it is Add and the user will enter patient info
      else 
      {
          $patientFirstName = "";
          $patientLastName = "";
          $patientMarried = "";
          $patientBirthDate = "";
      }
  } // end if GET

  // If it is a POST, we are coming from updatePatient.php
  // we need to determine action, then return to view.php
  elseif (isset($_POST['action'])) 
  {
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'patientId');
      $patientFirstName = filter_input(INPUT_POST, 'patientFirstName');
      $patientLastName = filter_input(INPUT_POST, 'patientlastName');
      $patientMarried = filter_input(INPUT_POST, 'patientMarried');
      $patientBirthDate = filter_input(INPUT_POST, 'patientBirthDate');

      if ($action == "Add") 
      {
          $result = $patientDatabase->addPatient ($patientFirstName, $patientLastName, $patientMarried, $patientBirthDate);
      } 
      elseif ($action == "Update") 
      {
          $result = $patientDatabase->updatePatient ($id, $patientFirstname, $patientLastName, $patientMarried, $patientBirthDate);
      }

      // Redirect to patient listing on view.php
      header('Location: view.php');
  } // end if POST

  // If it is neither POST nor GET, we go to view.php
  // This page should not be loaded directly
  else
  {
    header('Location: view.php');  
  }
      
?>
    

<html lang="en">
<head>
  <title><?= $action ?> </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    
<div class="container">
  <p></p>
  <form class="form-horizontal" action="updatePatient.php" method="post">
    
  <div class="panel panel-primary">
<div class="panel-heading"><h4><?= $action; ?> Patient</h4></div>
<p></p>
    <div class="form-group">
      <label class="control-label col-sm-2" for="patientFirstName">First Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="patientFirstName" placeholder="Enter First Name" name="patientFirstName" value="<?= $patientFirstName; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="patientLastName">Last Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="patientLastName" placeholder="Enter Last Name" name="patientLastName" value="<?= $patientLastName; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="patientMarried">Marital Status:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="patientmarried" placeholder="Enter Marital Status" name="patientMarried" value="<?= $patientMarried; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="patientBirthDate">Birth Date:</label>
      <div class="col-sm-10">          
        <input type="date" class="form-control" id="patientBirthDate" placeholder="Enter Birth Date" name="patientBirthDate" value="<?= $patientBirthDate; ?>">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php echo $action; ?> Patient</button>
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
  
  <div class="col-sm-offset-2 col-sm-10"><a href="./view.php">View Patient Records</a></div>
</div>
</div>

</body>
</html>