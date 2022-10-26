
<?php 
    $GLOBALS['hostname'] = 'localhost'; //hostname of sql server
    $GLOBALS['database'] = 'team2dbsite'; //database name
    $GLOBALS['username'] = 'root'; //username of sql account
    $GLOBALS['password'] = ''; //password of sql account (blank by default)$hostname = 'localhost'; //hostname of sql server
    $GLOBALS['$db'] = connectDatabase();
    $GLOBALS['$db']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    
    function connectDatabase() { //creates connection to database
        $dsn = "mysql:host=" . $GLOBALS['hostname'] .";dbname=". $GLOBALS['database'];
        
            try{ //Connect to database
            $db = new PDO($dsn,$GLOBALS['username'],$GLOBALS['password']);
        }
        
        catch (PDOException $e) { //Error messages
            $error_message = $e-> getMessage();
            echo "<p>An error occurred while connecting to the database: $error_message</p>";
        }
        
        $db->exec("use " . $GLOBALS['database'] . ";");
            
            return $db;
        
    }



    function deleteData(string $tableName, string $whereCondition, string $dataValue){
            
        $query = "DELETE FROM $tableName WHERE $whereCondition";
        try {
            $statement = $GLOBALS['$db']->prepare($query);
            if(substr_count($whereCondition,":dataValue") == 1){//adds parameterization support for on key
                $statement->bindParam(":dataValue", $dataValue, PDO::PARAM_STR);
            }
                $statement->execute();
                return $statement;//
                    //$result->closeCursor();
            
            } 
            catch (Exception $ex) {
                $error_message = $e-> getMessage();
                echo "<p>An error occurred Check SYNTAX for SELECT table and WHERE condition: $error_message</p>";
            }
    }
    
    function deleteDataOnkey($keyColumnName, $dataValue, $tableName){
        $whereCondition = "$keyColumnName = :dataValue";
        return deleteData($tableName, $whereCondition, $dataValue);
    }



    function selectData(string $tableName, string $whereCondition, string $dataValue){ //Where conditions and column names are not sanitized, so functions should regulate this. $dataValue is for other functions to use
        if($whereCondition == NULL)
            {
            $whereCondition = 'true';
            }
        $query = "SELECT * FROM $tableName WHERE $whereCondition;";
        
        try {
            $statement = $GLOBALS['$db']->prepare($query);

            if(substr_count($whereCondition,":dataValue") == 1){//adds parameterization support for on key
                $statement->bindParam(":dataValue", $dataValue, PDO::PARAM_STR);
                
            }
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_NUM);
            return $statement;
            //echo('result:' . $result . 'Params' . $statement->debugDumpParams());
            //$result->closeCursor();
            } 
            catch (Exception $ex) {
            $error_message = $e-> getMessage();
                echo "<p>An error occurred Check SYNTAX for SELECT table and WHERE condition: $error_message</p>";
            }
        
    }



    function selectDataOnKey($keyColumnName, $dataValue, $tableName){
        $whereCondition = "$keyColumnName = :dataValue";
        return selectData($tableName, $whereCondition, $dataValue);
    }



    function selectJoinData(string $tableName1, string $columnName1, string $tableName2, string $columnName2){

        $query = "SELECT * FROM $tableName1 JOIN $tableName2 ON $tableName1.$columnName1 = $tableName2.$columnName2;";
        echo($query);
        try {
            $result = $GLOBALS['$db']->query($query);
                    //$result->closeCursor();
            } 
        catch (Exception $ex) {
        $error_message = $e-> getMessage();
            echo "<p>An error occurred Check SYNTAX for SELECT table and WHERE condition: $error_message</p>";
        }
        $result->setFetchMode(PDO::FETCH_NUM);
        return $result;
    }



    function insertData(string $tableName, array $columnNames, array $insertData) {

        //initializes variables for for loops
        $stringColumnNames = '';
        $stringInsertData = '';
        echo(count($columnNames));

        for($i = 0; $i < count($columnNames); $i++){ //generates params and creates a column list string
            if($i >= 1){
                $stringColumnNames = $stringColumnNames . ', '; 
                $stringInsertData = $stringInsertData . ', '; 
            }
            $stringColumnNames = $stringColumnNames . "$columnNames[$i]";
            $stringInsertData = $stringInsertData . ":data$i";
        }
        


        //Prepared query gets columns and params inserted
        $mainquery = "INSERT INTO " . $tableName . "(" . $stringColumnNames . ")" . " VALUES (" . $stringInsertData . ");";

        $statement = $GLOBALS['$db']->prepare($mainquery);

        for($i = 0; $i < count($columnNames); $i++){ //binds the values to params
            $statement->bindParam(":data$i", $insertData[$i], PDO::PARAM_STR);
        }

        $statement->execute();
        $statement->closeCursor();

        echo('<div>a'.$mainquery. '</div>');
    }

    function updateData(string $tableName, array $columnNames, array $insertData, string $whereCondition, string $dataValue) { // a basic update function that should have functions that automatically format data for each table to fit. Where conditions and column names are not sanitized, so functions should regulate this. $dataValue is for other functions to use
        
        if($whereCondition == NULL or $whereCondition == '')// if where omitted, then it's true
        {
        $whereCondition = 'true';
        }
        //Prepared query gets all values to be inserted written into it by php (binding values was not working, hence the approach)
        $mainquery = "UPDATE $tableName SET ";

        for($i = 0; $i < count($columnNames); $i++){ //generates column names and parameters for the set portion of the query
            if($i >= 1){
                $mainquery = $mainquery . ', '; 
            }
            $mainquery = $mainquery . "$columnNames[$i] = :data$i";
        }

        $mainquery =  $mainquery . " WHERE " . $whereCondition . ";";
    
        $statement = $GLOBALS['$db']->prepare($mainquery);

        if(substr_count($whereCondition,":dataValue") == 1){//adds parameterization support for on key
            $statement->bindParam(":dataValue", $dataValue, PDO::PARAM_STR);
        }

        for($i = 0; $i < count($columnNames); $i++){ //binds the values to params
            $statement->bindParam(":data$i", $insertData[$i], PDO::PARAM_STR);
        }
        
        $statement->execute();
        $statement->closeCursor();
    
        echo('<div>a'. $mainquery. '</div>');
     }

    function updateDataOnkey($keyColumnName, $dataValue, $tableName, array $columnNames, array $insertData){ 

        $whereCondition = "$keyColumnName = :dataValue";
        updateData($tableName, $columnNames, $insertData, $whereCondition, $dataValue);
    }

    
?>
