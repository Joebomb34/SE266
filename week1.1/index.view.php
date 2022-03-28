<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Animal Array</title>
<!--styling the header-->
    <style>

        
        header{
            background: #e3e3e3;

            padding: 2em;

            text-align: center;
        }

    </style>

</head>
<!--using a for loop to display all the animals in the array-->
<body>

    <ul>
        <?php

            foreach ($animals as $animal){
                echo "<li>$animal</li>";
            }
        ?>
    </ul>

</body>
</html>