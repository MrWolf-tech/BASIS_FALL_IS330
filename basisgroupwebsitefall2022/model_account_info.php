<?php
    require_once('./database_functions.php');
    //all of these need to be renamed on any variants in order to correspond with the name of the model which will ensure compatibility between models on the same page
    $account_infoTableName = 'account_info'; //name of table at global level for functions
    $account_infoIDColumnName = 'customer_id'; //name of table id at global level for functions
    $account_infoColumnNames = array('customer_id','username','pass_hash', 'is_admin');//global variable for functions that contains the name of all columns in the table
    $account_infoInputColumnArray = array('username','pass_hash', 'is_admin'); //used specifically for updates, it omits the id from above
    $password_algo = PASSWORD_BCRYPT;
    
    function selectAccountInfo($column_number, string $search_value){
        $columnName = $GLOBALS['account_infoColumnNames'][$column_number];
        return selectDataOnKey($columnName, $search_value, $GLOBALS['account_infoTableName']);
    }

    function selectAccountInfoOnID(string $search_value){
        return selectAccountInfo(0, $search_value);
    }

    function deleteAccountInfo($column_number, string $search_value){
        $columnName = $GLOBALS['account_infoColumnNames'][$column_number];

        
        return deleteDataOnKey($columnName, $search_value, $GLOBALS['account_infoTableName']);
    }
    
    function deleteAccountInfoOnID($column_number, string $search_value){
        $columnName = $GLOBALS['account_infoColumnNames'][0];

        
        return deleteDataOnKey($columnName, $search_value, $GLOBALS['account_infoTableName']);
    }

    function insertAccountInfo(string $id ,string $username, string $password, $is_admin){
        $pass_hash = password_hash($password, $GLOBALS['password_algo']);
        $inputDataArray = array($id, $username, $pass_hash, $is_admin);
        insertData($GLOBALS['account_infoTableName'], $GLOBALS['account_infoColumnNames'], $inputDataArray);
    }
    
    function updateAccountInfoOnKey($keyColumnName, $dataValue, array $updateData){ //backend function for creating other customer update functions, should not be used without column name being hardcoded into array or function. Data value is part of where condition
        return updateDataOnkey($keyColumnName, $dataValue, $GLOBALS['account_infoTableName'], $GLOBALS['account_infoInputColumnArray'], $updateData);
    }

    function updateAccountInfoColumnOnKey($keyColumnName, String $targetColumnName, $dataValue, String $updateData){ //backend function for creating other customer update functions, should not be used without column names being hardcoded into array or function. Data value is part of where condition
        $columnArray = array($targetColumnName);
        $updateArray = array($updateData);
        return updateAccountInfoOnKey($keyColumnName, $dataValue, $columnArray, $updateData);
    }

    function updateAccountInfoColumnOnID($id, $column_name, $updateData){ //automatically uses customer ID
        return updateCustomerOnKey($GLOBALS['account_infoIDColumnName'], $column_name, $id, $updateData);
    }

    function updateAccountUsernameOnID(string $id, string $username){
        return updateAccountInfoColumnOnID($id, "username", $password);
    }

    function updateAccountPasswordOnID(string $id, string $password){
        $pass_hash = password_hash($password, $GLOBALS['password_algo']);
        return updateAccountInfoColumnOnID($id, "pass_hash", $pass_hash);
    }
    
    function authenticateAccountInfo(string $username, string $password){ //a select that returns the authenticated account id
        $whereCondition = "username = :dataValue0";
        $dataValueArray = array($username);
        $result = selectData($GLOBALS['account_infoTableName'], $whereCondition, $dataValueArray)->fetch();
        if(password_verify($password, $result[2])){ //if password verifies returns the id of the account
            return $result[0]; 
        }
        else{
            return null;
        }
        
    }

    ?>