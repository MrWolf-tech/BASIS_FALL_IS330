<?php
    require_once('./database_functions.php');
    
    function selectCustomer($column_number, string $search_value){
        $columnNames = array('customer_id','name','address','city','state','country','zip','phone_number','email');
        $tableName = 'customers';
        $columnName = $columnNames[$column_number];
    
        return selectDataOnKey($columnName, $search_value, $tableName);
    }

    function deleteCustomer($column_number, string $search_value){
        $columnNames = array('customer_id','name','address','city','state','country','zip','phone_number','email');
        $tableName = 'customers';
        $columnName = $columnNames[$column_number];

        
        return deleteDataOnKey($columnName, $search_value, $tableName);
    }
    function insertCustomer(string $name,string $address,string $city,string $state,string $country,string $zip,string $phone_number,string $email){
            require 'database_functions.php';
            $tableName = 'customers';
            $inputColumnArray = array('name', 'address', 'city', 'state', 'country', 'zip', 'phone_number', 'email');
            $inputDataArray = array($name, $address, $city, $state, $country, $zip, $phone_number, $email);
            insertData($tableName, $inputColumnArray, $inputDataArray);
        }

    ?>