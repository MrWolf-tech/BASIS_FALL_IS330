<?php
    $page_number = filter_input(INPUT_POST, 'page_number');
    $item_id = filter_input(INPUT_POST, 'item_id');
    $item_quantity = filter_input(INPUT_POST, 'item_quantity');

    $page_number = (int)$page_number;
    $length = count($_session['shopping_cart']); //gets length of shopping cart

    $_session['shopping_cart'][$length+1][0] = $item_id;
    $_session['shopping_cart'][$length+1][1] = $item_quantity;

    header("Location: ./catalog.php?page_number=$page_number");


?>