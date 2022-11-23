<?php
    require_once('./model_orders.php');
    require_once('./model_items.php');
    require_once('./model_order_items.php');
    require_once('./backend_accounts.php');

    class Order 
    {
        private $order_id;
        private $account;
        private $destination_address;
        private $destination_city;
        private $destination_state;
        private $destination_country;
        private $destination_zip;
        private $quote_discount;
        private $payment_method;
        private $order_items;


        const PASSWORD_ALGO = PASSWORD_BCRYPT;

        function constructor($accountID, $address, $city, $state, $country, $zip, $quoteDiscount, $paymentMethod){
            $this->setAccount($account);
            $this->setAddress($address);
            $this->setCity($city);
            $this->setState($state);
            $this->setCountry($country);
            $this->setZIP($zip);
            $this->setQuoteDiscount($quoteDiscount);
            $this->setPaymentMethod($paymentMethod);
        }

        private function setOrderID($param){ //private because ids should auto increment
            $this->order_id = $param;
        }
        function getOrderID(){
            return $this->order_id;
        }

        function setAccount($param){ //private because ids should auto increment
            $this->account = $param;
        }
        function getAccountID(){
            return $this->account;
        }

        function setAddress($param){
            $this->destination_address = $param;
        }
        function getAddress(){
            return $this->destination_address;
        }

        function setCity($param){
            $this->destination_city = $param;
        }
        function getCity(){
            return $this->destination_city;
        }

        function setState($param){
            $this->destination_state = $param;
        }
        function getState(){
            return $this->destination_state;
        }

        function setCountry($param){
            $this->destination_country = $param;
        }
        function getCountry(){
            return $this->destination_country;
        }

        function setZIP($param){
            $this->destination_zip = $param;
        }
        function getZIP(){
            return $this->destination_zip;
        }

        function setQuoteDiscount($param){
            $this->quote_discount = $param;
        }
        function getQuoteDiscount(){
            return $this->quote_discount;
        }
        
        function setPaymentMethod($param){
            $this->payment_method = $param;
        }
        function getPaymentMethod(){
            return $this->payment_method;
        }

        function setOrderItems(array $param){
            $this->order_items = $param;
        }
        function getOrderItems(){
            return $this->order_items;
        }
        


        /*getAccount(){ //returns account as json (implement if necessary)

        }*/
        

        
        function insertOrderObject(Account $ordering_account){
            insertOrder($this->account->account_id, $this->destination_address, $this->destination_city, $this->destination_state, $this->destination_country, $this->destination_zip, $this->quote_discount, $this->payment_method);
            foreach($this->order_items as $order_item){ //iterates through order items array to insert all order items using the parent order objects id
                $order_item->insertOrderItemObject($order_id);
            }
        }

        function updateAccount(){ //modifies account in database except for password NOT FINISHED
            updateAccountUsernameOnID($this->account_id, $this->account_username);
                
        }
        
    }
    
    class Item 
    {
        private $item_id;
        private $item_name;
        private $item_price;
        private $item_photo;


        const PASSWORD_ALGO = PASSWORD_BCRYPT;

        function constructor($name,$price,$photo){
            $this->setName($name);
            $this->setPrice($price);
            $this->setPhoto($photo);
        }

        private function setItemID($param){ //private because ids should auto increment
            $this->item_id = $param;
        }
        function getItemID(){
            return $this->item_id;
        }
        
        function setName($param){
            $this->item_name = $param;
        }
        function getName(){
            return $this->item_name;
        }

        function setPrice($param){
            $this->item_price = $param;
        }
        function getPrice(){
            return $this->item_price;
        }

        function setPhoto($param){
            $this->item_photo = $param;
        }
        function getPhoto(){
            return $this->item_photo;
        }

        


        /*getAccount(){ //returns account as json (implement if necessary)

        }*/
        function selectItemObject($id){ //retrieves account from database by id
            if($id !== null){ //if id not null
            $result1 = selectItemOnID($id)->fetch();
            $this->setItemID($result1[0]);
            $this->setName($result1[1]);
            $this->setPrice($result1[2]);
            $this->setPhoto($result1[3]);
        }
        
        function insertItemObject(){
                insertItem($this->item_name, $this->item_price, $this->item_photo);
            }
        }

        function updateAccount(){ //modifies account in database except for password NOT FINISHED
            updateAccountUsernameOnID($this->account_id, $this->account_username);
                
            }
        
    }

    class OrderItem 
    {
        private $order_item_id;
        private $item_id;
        private $item_quantity;
        private $quote_price; //this is used so prices don't change


        const PASSWORD_ALGO = PASSWORD_BCRYPT;

        function constructor(Item $item, $quantity){
            $this->setItemID($item->getItemID());
            $this->setQuantity($quantity);
            $this->setPrice($item->getPrice());
        }

        private function setOrderItemID($param){ //private because ids should auto increment
            $this->item_id = $param;
        }
        function getOrderItemID(){
            return $this->item_id;
        }

        function setItemID($param){ //private because ids should auto increment
            $this->item_id = $param;
        }
        function getItemID(){
            return $this->item_id;
        }
        
        function setQuantity($param){
            $this->item_quantity = $param;
        }
        function getQuantity(){
            return $this->item_quantity;
        }

        function setPrice($param){
            $this->quote_price = $param;
        }
        function getPrice(){
            return $this->quote_price;
        }
        


        /*getAccount(){ //returns account as json (implement if necessary)

        }*/
        function selectOrderItemObject($id){ //retrieves account from database by id
            if($id !== null){ //if id not null
            $result1 = selectOrderItemOnID($id)->fetch();
            $this->setOrderItemID($result1[0]);
            $this->setItemID($result1[2]);
            $this->setQuantity($result1[3]);
            $this->setPrice($result1[4]);
        }
        
        function insertOrderItemObject($order_id){ //uses the passed value of the parent order object to insert order items
                insertOrderItem($order_id, $this->item_id, $this->item_price, $this->item_photo);
            }
        }

        /*function updateAccount(){ //modifies account in database except for password NOT FINISHED
            updateAccountUsernameOnID($this->account_id, $this->account_username);
                
            }*/
        
    }
?>