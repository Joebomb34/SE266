<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Assignment 1.G</title>


</head>
<body>

    <!--using the foreach loop to go through the array and call the function along with placing the output in a unordered list. -->

    <ul>
        <?php foreach ($num as $num) : ?>
            <li><?= fizzBuzz($num); ?></li>
        <?php endforeach; ?>

            
        
    </ul>

</body>
</html>