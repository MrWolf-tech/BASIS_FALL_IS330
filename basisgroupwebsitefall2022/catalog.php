<?php
    require_once('./backend_items.php');

    if(!isset($_session['shopping_cart']))
    {
        $_session['shopping_cart'] = array(array());
    }
    
    

    if(count($_GET) != 0){
        $page_number = filter_input(INPUT_GET, 'page_number');
    }
    else{//in case there is no page number
        header("Location: ./catalog.php?page_number=0");
    }

    for($i = 0; $i < count($_session['shopping_cart']); $i++){
        $itemObject = new Item();
        $itemObject->selectItemObject($_session['shopping_cart'][$i][0]);
        print("
            <form action='addtocart.php' method='post'>
                <input type='hidden' id='page_number' name='page_number' value='$page_number'>
                <input type='hidden' id='item_id' name='item_id' value='" . $itemObject->getItemID() . "'>
                <img class='item_img' src='" . $itemObject->getPhoto() . "'/>
                <p> " . $itemObject->getName() . "</p>
                <p> $" . $itemObject->getPrice() . "</p>
                <p> Quantity: " . $_session['shopping_cart'][$i][1] . "</p>
            </form>"
        );
    }

    $items = selectItemsPaginatedAsObjects($page_number);
    foreach($items as $item){
        print("
            <form action='addtocart.php' method='post'>
                <input type='hidden' id='page_number' name='page_number' value='$page_number'>
                <input type='hidden' id='item_id' name='item_id' value='" . $item->getItemID() . "'>
                <img class='item_img' src='" . $item->getPhoto() . "'/>
                <p> " . $item->getName() . "</p>
                <p> $" . $item->getPrice() . "</p>
                <input type='number' id='quantity' name='quantity' value='1' min=0 max=50/>
                <input type='submit' name='Order'>Order</input>
            </form>"
        );
    }

?>