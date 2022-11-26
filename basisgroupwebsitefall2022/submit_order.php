<?php
require_once('./header.php');
require_once('./backend_items.php');


if(count($_POST) != 0){ //if _post array is not empty
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $country = filter_input(INPUT_POST, 'country');
    $zip = filter_input(INPUT_POST, 'zip');
    $payment_method = filter_input(INPUT_POST, 'payment_method');
    

}

if(!isset($_SESSION['shopping_cart']))
{
    header("Location: ./catalog.php?page_number=0");
}

if(!isset($_SESSION['account']))
{
    header("Location: ./logon_page.php");
}

$order = new Order();
$order->constructor($_SESSION['account'], $address, $city, $state, $country, $zip, 0, $payment_method);
$order->setOrderItemsAuto($_SESSION['shopping_cart']);
$order->insertOrderObject();
$_SESSION['shopping_cart'] = null;
?>