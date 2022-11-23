<?php
    require_once('./database_functions.php');
    //all of these need to be renamed on any variants in order to correspond with the name of the model which will ensure compatibility between models on the same page
    $ordersTableName = 'orders'; //name of table at global level for functions
    $ordersIDColumnName = 'order_id'; //name of table id at global level for functions
    $ordersColumnNames = array('order_id', 'customer_id', 'destination_address', 'destination_city', 'destination_state','destination_country','destination_zip','quote_discount','payment_method');//global variable for functions that contains the name of all columns in the table
    $ordersInputColumnArray = array('customer_id', 'destination_address', 'destination_city', 'destination_state','destination_country','destination_zip','quote_discount','payment_method'); //used specifically for inserts and updates, it omits the id from above
    
    function selectOrder($column_number, string $search_value){
        $columnName = $GLOBALS['ordersColumnNames'][$column_number];
    
        return selectDataOnKey($columnName, $search_value, $GLOBALS['ordersTableName']);
    }

    function selectOrderOnID(string $search_value){
        return selectOrder(0, $search_value);
    }

    function deleteOrder($column_number, string $search_value){
        $columnName = $GLOBALS['ordersColumnNames'][$column_number];
        return deleteDataOnKey($columnName, $search_value, $GLOBALS['ordersTableName']);
    }

    function insertOrder($customer_id, string $destination_address, string $destination_city, string $destination_state, string $destination_country, string $destination_zip, $quote_discount, $payment_method){
        $inputDataArray = array($customer_id, $destination_address, $destination_city, $destination_state, $destination_country, $destination_zip, $quote_discount, $payment_method);
        insertData($GLOBALS['ordersTableName'], $GLOBALS['ordersInputColumnArray'], $inputDataArray);
    }
    
    function updateOrderOnKey($keyColumnName, $dataValue, array $updateData){ //backend function for creating other order update functions, should not be used without column name being hardcoded into array or function. Data value is part of where condition
        return updateDataOnkey($keyColumnName, $dataValue, $GLOBALS['ordersTableName'], $GLOBALS['ordersInputColumnArray'], $updateData);
    }

    function updateOrderOnID(string $id, $customer_id, string $destination_address, string $destination_city, string $destination_state, string $destination_country, string $destination_zip, $quote_discount, $payment_method){
        $inputDataArray = array($customer_id, $destination_address, $destination_city, $destination_state, $destination_country, $destination_zip, $quote_discount, $payment_method);
        return updateOrderOnKey($GLOBALS['ordersIDColumnName'], $id, $inputDataArray);
    }

    ?>