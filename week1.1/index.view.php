<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Associative Array</title>
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
        <?php foreach ($task as $key => $val) : ?>
            <li><strong><?= $key; ?></strong><?= $val; ?></li>
        <?php endforeach; ?>

            
        
    </ul>

</body>
</html>