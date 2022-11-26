<?php
    require_once('./database_functions.php');
    //all of these need to be renamed on any variants in order to correspond with the name of the model which will ensure compatibility between models on the same page
    $itemsTableName = 'items'; //name of table at global level for functions
    $itemsIDColumnName = 'item_id'; //name of table id at global level for functions
    $itemsColumnNames = array('item_id','item_name', 'price', 'photo');//global variable for functions that contains the name of all columns in the table
    $itemsInputColumnArray = array('item_name', 'price', 'photo'); //used specifically for inserts and updates, it omits the id from above
    $page_offset = 10; //Amount of Items on a page
    
    function selectItem($column_number, string $search_value){
        $columnName = $GLOBALS['itemsColumnNames'][$column_number];
    
        return selectDataOnKey($columnName, $search_value, $GLOBALS['itemsTableName']);
    }

    function selectItemsPaginated($page_number){ //returns a configured amount of items
        

        $lower_limit = $page_number * $GLOBALS['page_offset'];
        $higher_limit = $page_number * $GLOBALS['page_offset'] + $GLOBALS['page_offset'];
        $data_values = array();
        return selectData($GLOBALS['itemsTableName'], "true limit $lower_limit,$higher_limit", $data_values);
    }

    

    function selectItemOnID(string $search_value){
        return selectItem(0, $search_value);
    }

    function deleteItem($column_number, string $search_value){
        $columnName = $GLOBALS['itemsColumnNames'][$column_number];
        return deleteDataOnKey($columnName, $search_value, $GLOBALS['itemsTableName']);
    }

    function insertItem(string $item_name, $price, string $photo){
        $inputDataArray = array($item_name, $price, $photo);
        insertData($GLOBALS['itemsTableName'], $GLOBALS['itemsInputColumnArray'], $inputDataArray);
    }
    
    function updateItemOnKey($keyColumnName, $dataValue, array $updateData){ //backend function for creating other item update functions, should not be used without column name being hardcoded into array or function. Data value is part of where condition
        return updateDataOnkey($keyColumnName, $dataValue, $GLOBALS['itemsTableName'], $GLOBALS['itemsInputColumnArray'], $updateData);
    }

    function updateItemOnID(string $id, string $item_name, $price, string $photo){
        $inputDataArray = array($item_name, $price, $photo);
        return updateItemOnKey($GLOBALS['itemsIDColumnName'], $id, $inputDataArray);
    }

    ?>