<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Lazy Red Cheeks', 'price' => 10],
    ['name' => 'Pornstar Martini', 'price' => 12],
    ['name' => 'Cosmopolitan', 'price' => 11],
    ['name' => 'Margarita', 'price' => 12],
    ['name' => 'Long Island Ice Tea', 'price' => 12],
    ['name' => 'Bart', 'price' => 10],
];

$totalValue = 0;


if (isset($_POST['submit'])) {
    $amount = 0;
    $listProducts = $_POST['products'];
    //var_dump($_POST['products']);

    foreach ($listProducts as $selected => $product) {
        $totalValue = $totalValue + $products[$product]['price'];
        $amount++;
        
    }

}


require 'form-view.php';