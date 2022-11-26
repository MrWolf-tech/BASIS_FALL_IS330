<?php
    require_once('./backend_items.php');
    session_start();
    $page_number = filter_input(INPUT_POST, 'page_number');
    $item_id = filter_input(INPUT_POST, 'item_id');
    $item_quantity = filter_input(INPUT_POST, 'item_quantity');

    $page_number = (int)$page_number;
    $length = count($_SESSION['shopping_cart']); //gets length of shopping cart

    $_SESSION['shopping_cart'][$length][0] = $item_id;
    $_SESSION['shopping_cart'][$length][1] = $item_quantity;
    header("Location: ./catalog_page.php?page_number=$page_number");


?>