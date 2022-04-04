<?php
function age ($bdate) {
   $date = new DateTime($bdate);
   $now = new DateTime();
   $interval = $now->diff($date);
   return $interval->y;
}

function isDate($dt) {
   try {
      $d = new DateTime($dt);
      return (true);
   } catch(Exception $e) {
      return false;
   }
}

function bmi ($ft, $inch, $weight) {
   // you will need to write
}

function bmiDescription ($bmi) {
   // you will need to write
}



if(isset($_POST['submitBtn'])){
    $selectedfname = filter_input (INPUT_POST, 'fname');
    $selectedlname = filter_input(INPUT_POST, 'lname');
    $selectedstatus = filter_input (INPUT_POST, 'status');
    $selectedbirth = filter_input(INPUT_POST, 'birthdate');
      
    echo $selectedfname;
    echo " ";
    echo $selectedlname;
    echo " ";
    echo $selectedstatus;
    echo " ";
    echo $selectedbirth;
    echo " ";
    echo age($selectedbirth);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Doctor's Form</title>
    </head>
    <body>
        <h1>Doctor's Form</h1>

        <form action="index.php" method="post">

            <strong>First Name: </strong><input type="text" name="fname" value=""><br/>
            <strong>Last Name: </strong><input type="text" name="lname" value=""><br/>
            <strong>Status: </strong><input type="radio" value="Married" name="status">Married
            <input type="radio" value="Single" name="status">Single<br/>
            <strong>Birth Date: </strong><input type="date" value="" name="birthdate"><br/>

            <input type="submit" name="submitBtn"/>
        </form>

    </body>
</html>