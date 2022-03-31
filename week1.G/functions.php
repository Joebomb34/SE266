<?php

function fizzBuzz($num){

//this code operand was made possible by stackoverflow, the modulo a gives remainder and if there is a remainder the program will only print the number.

    if ($num % 2 == 0){

        echo "Fizz";
    }

    if ($num % 3 == 0){

        echo "Buzz";
    }

    elseif ($num % 2 == 0 && $num % 3 == 0){

        echo "FizzBuzz";
    }

    elseif($num % 2 != 0 && $num % 3 != 0){

        echo "$num";
    }




}

?>

