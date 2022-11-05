<?php
    session_start();
    require_once('./model_customers.php');
    
    if(count($_POST) != 0){ //if _post array is not empty
        $id = $_SESSION["update_id"];
        $name = filter_input(INPUT_POST, 'name'); 
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $country = filter_input(INPUT_POST, 'country');
        $zip = filter_input(INPUT_POST, 'zip');
        $phoneNumber = filter_input(INPUT_POST, 'phone_number');
        $email = filter_input(INPUT_POST, 'email');

        if(updateCustomerOnID($id, $name, $address, $city, $state, $country, $zip, $phoneNumber, $email) == true){
            Print('Update Successful');//prints results of update
        } 
        else{
            Print('Update Failed');
        }
    }

?>
<a href='update_customer_select.php'>return to selector</a>