<?php

include_once __DIR__ . '\..\week2.A\include\header.php';

$task = [
    'title' => 'Grocery Shopping',
    'due' => 'Tomorrow',
    'assigned_to' => 'Joe',
    'completed' => false,
    'accepted' => true
];


require 'index.view.php';

include_once __DIR__ . '\..\week2.A\include\footer.php';