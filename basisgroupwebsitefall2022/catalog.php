<script>
    function toggleShoppingCart(){
        var cart = document.getElementById("shopping_cart");
        if(cart.style.display === "none"){
            cart.style.display = "block";
        } 
        else{
            cart.style.display = "none";
        }
    }
</script>
<div class="insertform">
    <div>
        <?php
    require_once('./backend_items.php');
    if(!isset($_SESSION['shopping_cart']))
    {
        $_SESSION['shopping_cart'] = array();
    }


    if(count($_GET) != 0){
        $page_number = filter_input(INPUT_GET, 'page_number');
    }
    else{//in case there is no page number
        header("Location: ./catalog_page.php?page_number=0");
    }
    print("<button onclick=toggleShoppingCart()>Shopping Cart</button>");
    print("<div id=shopping_cart>");//opens shopping cart div
    for($i = 0; $i < count($_SESSION['shopping_cart']); $i++){
        $itemObject = new Item();
        $itemObject->selectItemObject($_SESSION['shopping_cart'][$i][0]);
        print("
            <form method='post'>
                <input type='hidden' id='page_number' name='page_number' value='$page_number'> <!--stores page number for return to page-->
                <input type='hidden' id='item_id' name='item_id' value='" . $itemObject->getItemID() . "'>
                <input type='hidden' id='index' name='index' value='" . $i . "'>
                <img class='item_img' src='" . $itemObject->getPhoto() . "'/>
                <p> " . $itemObject->getName() . "</p>
                <p> $" . $itemObject->getPrice() . "</p>
                <p> Quantity: " . $_SESSION['shopping_cart'][$i][1] . "</p>
            </form>"
        );
    }
    print("
        <a href='order_confirm_page.php'>confirm order</a>
        </div>
    ");//closes shopping cart div and adds order button
    print("<div id=catalog>");//opens catalog div
    $items = selectItemsPaginatedAsObjects($page_number);//selects a page full of catalog items
    foreach($items as $item){//for each catalog item adds catalog entry in a from
        print("
            <form action='addtocart.php' method='post'>
                <input type='hidden' id='page_number' name='page_number' value='$page_number'>
                <input type='hidden' id='item_id' name='item_id' value='" . $item->getItemID() . "'>
                <img class='item_img' src='" . $item->getPhoto() . "'/>
                <p> " . $item->getName() . "</p>
                <p> $" . $item->getPrice() . "</p>
                <input type='number' id='item_quantity' name='item_quantity' value='1' min=0 max=50/>
                <input type='submit' value='Add to Cart'></input>
            </form>"
        );
    }
    print("</div>");//closes catalog div

        ?>
    </div>
</div>