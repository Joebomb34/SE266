<?php
    
    include_once __DIR__ . '/model/patients.php';
    include_once __DIR__ . '/include/functions.php';

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
    // If POST, delete the requested team before listing all teams
    if (isPostRequest()) {
        $id = filter_input(INPUT_POST, 'patientId');
        $patientDatabase->deletePatient ($id);

    }
    $patientListing = $patientDatabase->getPatients();
    
?>
<html lang="en">
<head>
  <title>View Patient Records</title> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        
    <div class="col-sm-offset-2 col-sm-10">
        <h1>Patient Records</h1>
        <br />
        <a href="updatePatient.php?action=Add">Add Patient</a>      
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Patient First Name</th>
                <th>Patient Last Name</th>
                <th>Marrital Status</th>
                <th>Date of Birth</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($patientListing as $row): ?>
            <tr>
                <td>
                    <form action="view.php" method="post">
                        <input type="hidden" name="patientId" value="<?= $row['id']; ?>" />
                        <button class="btn glyphicon glyphicon-trash" type="submit"></button>
                        <?php echo $row['patientFirstname']; ?>
                    </form>   
                </td>
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