<?php

//Grabs a text file
//Each line of the file is another row in the array
//This assumes the file "names.txt" is stored in the upload directory
$names = file('upload/names.txt');
echo $name[0]. "*** <br/>";