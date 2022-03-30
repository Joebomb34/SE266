<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Boolean & Conditionals</title>

</head>

<body>

    <h1>Task for the Day</h1>

    <ul>
            <li>
                <strong>Name: </strong> <?= $task['title']; ?>
            </li>

            <li>
                <strong>Due Date: </strong> <?= $task['due']; ?>
            </li>

            <li>
                <strong>Person Responsible: </strong> <?= $task['assigned_to']; ?>
            </li>

<!---Read the boolean and then if it's true say something if it its false say something else.-->
            <li>
                <strong>Status: </strong>

                <?= $task['completed'] ? 'Finished' : 'Incomplete'; ?>

                <?php
//if-else for the completed section to get the same result but have more control over what the program is saying
                /*if ($task['completed']) {

                    echo 'Complete';

                } else {

                    echo 'Incomplete';

                }*/
                ?>
        
            </li>
        
    </ul>

</body>
</html>