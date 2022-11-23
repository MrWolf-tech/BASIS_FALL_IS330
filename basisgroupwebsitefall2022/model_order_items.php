<?php
    require_once('./database_functions.php');
    //all of these need to be renamed on any variants in order to correspond with the name of the model which will ensure compatibility between models on the same page
    $orderItemsTableName = 'order_items'; //name of table at global level for functions
    $orderItemsIDColumnName = 'order_item_id'; //name of table id at global level for functions
    $orderItemsColumnNames = array('order_item_id','order_id', 'item_id', 'quantity', 'quote_price');//global variable for functions that contains the name of all columns in the table
    $orderItemsInputColumnArray = array('order_id', 'item_id', 'quantity', 'quote_price'); //used specifically for inserts and updates, it omits the id from above
    
    function selectOrderItem($column_number, string $search_value){
        $columnName = $GLOBALS['orderItemsColumnNames'][$column_number];
    
        return selectDataOnKey($columnName, $search_value, $GLOBALS['orderItemsTableName']);
    }

    function selectOrderItemOnID(string $search_value){
        return selectOrderItem(0, $search_value);
    }
    function selectOrderItemOnOrderID(string $search_value){
        return selectOrderItem(1, $search_value);
    }

    function deleteOrderItem($column_number, string $search_value){
        $columnName = $GLOBALS['orderItemsColumnNames'][$column_number];
        return deleteDataOnKey($columnName, $search_value, $GLOBALS['orderItemsTableName']);
    }

    function insertOrderItem($order_id, $item_id, $quantity, $quote_price){
        $inputDataArray = array($order_id, $item_id, $quantity, $quote_price);
        insertData($GLOBALS['orderItemsTableName'], $GLOBALS['orderItemsInputColumnArray'], $inputDataArray);
    }
    
    function updateOrderItemOnKey($keyColumnName, $dataValue, array $updateData){ //backend function for creating other orderItems update functions, should not be used without column name being hardcoded into array or function. Data value is part of where condition
        return updateDataOnkey($keyColumnName, $dataValue, $GLOBALS['orderItemsTableName'], $GLOBALS['orderItemsInputColumnArray'], $updateData);
    }

    function updateOrderItemOnID(string $id, $order_id, $item_id, $quantity, $quote_price){
        $inputDataArray = array($order_id, $item_id, $quantity, $quote_price);
        return updateOrderItemOnKey($GLOBALS['orderItemsIDColumnName'], $id, $inputDataArray);
    }

    ?>