<!--item_name, item_price, photo-->
<?php
require_once('./backend_items.php');
	if(count($_POST) != 0) //if _post array is not empty
		$item_name = filter_input(INPUT_POST, 'item_name');
		$price = filter_input(INPUT_POST, 'price');
		$photo = filter_input(INPUT_POST, 'photo');
		$item = new Item();
		$item->constructor($item_name, $price, $photo);
		$item->insertItem();

?>
	<div class="insertform">
	<div>
	<form id="additemForm" method="post" action="" name="addItemForm">
		<h1 class='formName'>Insert Item</h1>

		<label for="item_name">Item Name</label>
		<input required type="text" id="item_name" name="item_name" placeholder="Item_name"/>

		<label for="price">Price</label>
		<input required type="text" id="price" name="price" placeholder="Price"/>
		
		<label for="photo">Photo</label>
		<input required type="text" id="photo" name="photo" placeholder="Photo"/>

		<input type="submit" id="item_submit" name="Submit"/>
	</form>	
	</div>
	</div>