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

function bmi ($inch, $weight) {
   $bmi = ($weight / $inch / $inch) * 703;
   if($bmi <= 18.5):
        $bmidesc = round($bmi, 1) . " Underweight";

    elseif($bmi <= 24.9 && $bmi >= 18.6):
        $bmidesc = round($bmi, 1) . " Normal Weight";

    elseif($bmi <= 29.9 && $bmi >= 25):
        $bmidesc = round($bmi, 1) . " Overweight";

    else:
        $bmidesc = round($bmi, 1) . " Obsese";

    endif;
   return $bmidesc;
}


if(isset($_POST['submitBtn'])){
    $selectedfname = filter_input (INPUT_POST, 'fname');
    $selectedlname = filter_input(INPUT_POST, 'lname');
    $selectedstatus = filter_input (INPUT_POST, 'status');
    $selectedbirth = filter_input(INPUT_POST, 'birthdate');
    $selectedheight = filter_input(INPUT_POST, 'height');
    $selectedweight = filter_input(INPUT_POST, 'weight');
      
    echo $selectedfname;
    echo ' ';
    echo $selectedlname;
    echo ' ';
    echo $selectedstatus;
    echo ' ';
    echo $selectedbirth;
    echo ' ';
    echo age($selectedbirth);
    echo ' ';
    echo bmi($selectedheight, $selectedweight);
    echo' ';
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
            <strong>Height (in inches): </strong><input type="number" value="" name="height"><br/>
            <strong>Weight (in pounds): </strong><input type="number" value="" name="weight"><br/>

            <input type="submit" name="submitBtn"/>
        </form>
        
    </body>
</html>