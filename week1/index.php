<?php

include_once __DIR__ . '\..\week2.A\include\header.php';
//creating an array of animals to be displayed
$animals = [
    'Horse',
    'Dog',
    'Cat',
    'Mouse',
    'Pig'
];

//requireing the html
require 'index.view.php';

include_once __DIR__ . '\..\week2.A\include\footer.php';
?>