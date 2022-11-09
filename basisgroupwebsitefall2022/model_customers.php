<?php
    require_once('./database_functions.php');
    //all of these need to be renamed on any variants in order to correspond with the name of the model which will ensure compatibility between models on the same page
    $customersTableName = 'customers'; //name of table at global level for functions
    $customersIDColumnName = 'customer_id'; //name of table id at global level for functions
    $customersColumnNames = array('customer_id','name','address','city','state','country','zip','phone_number','email');//global variable for functions that contains the name of all columns in the table
    $customersInputColumnArray = array('name', 'address', 'city', 'state', 'country', 'zip', 'phone_number', 'email'); //used specifically for inserts and updates, it omits the id from above
    
    function selectCustomer($column_number, string $search_value){
        $columnName = $GLOBALS['customersColumnNames'][$column_number];
    
        return selectDataOnKey($columnName, $search_value, $GLOBALS['customersTableName']);
    }

    function selectCustomerOnID(string $search_value){
        return selectCustomer(0, $search_value);
    }

    function deleteCustomer($column_number, string $search_value){
        $columnName = $GLOBALS['customersColumnNames'][$column_number];
        return deleteDataOnKey($columnName, $search_value, $GLOBALS['customersTableName']);
    }

    function insertCustomer(string $name,string $address,string $city,string $state,string $country,string $zip,string $phone_number,string $email){
        $inputDataArray = array($name, $address, $city, $state, $country, $zip, $phone_number, $email);
        insertData($GLOBALS['customersTableName'], $GLOBALS['customersInputColumnArray'], $inputDataArray);
    }
    
    function updateCustomerOnKey($keyColumnName, $dataValue, array $updateData){ //backend function for creating other customer update functions, should not be used without column name being hardcoded into array or function. Data value is part of where condition
        return updateDataOnkey($keyColumnName, $dataValue, $GLOBALS['customersTableName'], $GLOBALS['customersInputColumnArray'], $updateData);
    }

    function updateCustomerOnID(string $id, string $name, string $address, string $city, string $state, string $country, string $zip, string $phoneNumber, string $email){
        $inputDataArray = array($name, $address, $city, $state, $country, $zip, $phoneNumber, $email);
        return updateCustomerOnKey($GLOBALS['customersIDColumnName'], $id, $inputDataArray);
    }

    ?>