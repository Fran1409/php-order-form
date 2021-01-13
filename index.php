<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

// We are going to use session variables so we need to enable sessions
session_set_cookie_params(0);
session_start();

require 'product.php';

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

$product1 = new Products();
$product1->setProduct("Lazy Red Cheeks", "10");

$product2 = new Products();
$product2->setProduct("Pornstar Martini", "12");

$product3 = new Products();
$product3->setProduct("Cosmopolitan", "11");

$product4 = new Products();
$product4->setProduct("Margarita", "12");

$product5 = new Products();
$product5->setProduct("Long Island Ice Tea", "12");

$product6 = new Products();
$product6->setProduct("Bart", "10");

$tapas1 = new Products();
$tapas1->setProduct("Tapas box 1 person", "15");

$tapas2 = new Products();
$tapas2->setProduct("Tapas box 2 person", "30");

$tapas3 = new Products();
$tapas3->setProduct("Tapas box 3 person", "45");

$tapas4 = new Products();
$tapas4->setProduct("Tapas box 4 person", "60");

if (empty($_GET) || $_GET['food'] == 0) {
    $products = [
        $product1,
        $product2,
        $product3,
        $product4,
        $product5,
        $product6,
    ];
} else if (($_GET['food']) == 1) {
    $products = [
        $tapas1,
        $tapas2,
        $tapas3,
        $tapas4,
    ];
}

if (isset($_POST['submit'])) {
    $amount = 0;
    $listProducts = $_POST['products'];
    //var_dump($_POST['products']);

    // Session variables
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['street'] = $_POST['street'];
    $_SESSION['streetnumber'] = $_POST['streetnumber'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['zipcode'] = $_POST['zipcode'];


    // Get total value of ordered items
    foreach ($listProducts as $selected => $productNumber) {
        $price = $products[$productNumber]['price'];
        $totalValue = $totalValue + $price;
        $amount++;
        
    }

    // Required fields are not empty. Zip code are only numbers. Email address is valid. Show it at the top of the form.
    if(empty($_POST['email']) || empty($_POST['street']) || empty($_POST['streetnumber']) || empty($_POST['city']) || empty($_POST['zipcode'])){
        echo '<div class="alert alert-danger"> Fill in the required fields (email, street, streetnumber, zipcode, city)! </br></div>';

    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger"> Invalid email format! </br></div>';

    } else if (!is_numeric($_POST['zipcode'])) {
        echo '<div class="alert alert-danger"> Zipcode needs to be numeric! </div>';

    } else {
        $email = $_POST['email'];
        $street = $_POST['street'];
        $streetnumber = $_POST['streetnumber'];
        $city = $_POST['city'];
        $zipcode = $_POST['zipcode'];

        // Show an order confirmation
        if (empty($_GET) || $_GET['food'] == 0) {
            $orderConfirm = "You ordered " . $amount . " cocktails with a total of <strong>&euro; " . $totalValue . "</strong>.</br> It will be delivered to " . $street . " " . $streetnumber . "- " . $zipcode . " " . $city .".";
        } else if (($_GET['food']) == 1) {
            $orderConfirm = "You ordered " . $amount . " tapas with a total of <strong>&euro; " . $totalValue . "</strong>.</br> It will be delivered to " . $street . " " . $streetnumber . "- " . $zipcode . " " . $city .".";
        }
    }

    

}

// remove all session variables
//session_unset();

// destroy the session
//session_destroy();

require 'form-view.php';