
<?php 
    $GLOBALS['hostname'] = 'localhost'; //hostname of sql server
    $GLOBALS['database'] = 'team2dbsite'; //database name
    $GLOBALS['username'] = 'root'; //username of sql account
    $GLOBALS['password'] = ''; //password of sql account (blank by default)$hostname = 'localhost'; //hostname of sql server
    $GLOBALS['$db'] = connectDatabase();

    
function connectDatabase() {
    $hostname = 'localhost'; //hostname of sql server
    $database = 'team2dbsite'; //database name
    $username = 'root'; //username of sql account
    $password = ''; //password of sql account (blank by default)$hostname = 'localhost'; //hostname of sql server


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



function deleteData($tableName, $whereCondition){
		
    $query = "DELETE FROM $tableName WHERE $whereCondition";
    try {
        $result = $GLOBALS['$db']->query($query);
				$result->closeCursor();
		} 
    catch (Exception $ex) {
    $error_message = $e-> getMessage();
        echo "<p>An error occurred Check SYNTAX for DELETE table and WHERE condition: $error_message</p>";
    }
}

function selectData($tableName, $whereCondition){
    if($whereCondition == NULL)
        {
        $whereCondition = 'true';
        }
    $query = "SELECT * FROM $tableName WHERE $whereCondition";
    echo($query);
    try {
        $result = $GLOBALS['$db']->query($query);
				//$result->closeCursor();
		} 
    catch (Exception $ex) {
    $error_message = $e-> getMessage();
        echo "<p>An error occurred Check SYNTAX for SELECT table and WHERE condition: $error_message</p>";
    }
    return $result;
}

function selectJoinData($tableName1, $columnName1, $tableName2, $columnName2){

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

function deleteDataOnkey($columnName, $dataValue, $tableName){
    $whereCondition = "$columnName = '$dataValue'";
    deleteData($tableName, $whereCondition);
}

function insertData(string $tableName, array $columnNames, array $insertData) {
    $GLOBALS['$db'] = connectDatabase();

    //initializes variables for for loops
    $stringColumnNames = '';
    $stringInsertData = '';

    foreach($columnNames as $columnName){ //converts input array to string for SQL query insertion
        //input sanitization goes here
        $stringColumnNames =  $stringColumnNames . $columnName . ", ";
    }
    foreach($insertData as $insertDatum){ //converts input array to string for SQL query insertion
        //input sanitization goes here
        $stringInsertData =  $stringInsertData . "'" . $insertDatum . "', ";
    }

    //removes whitespace and additional comma for query syntax
    $stringColumnNames = substr($stringColumnNames, 0, strlen($stringColumnNames)-2);
    $stringInsertData = substr($stringInsertData, 0, strlen($stringInsertData)-2);

    //Prepared query gets all values to be inserted written into it by php (binding values was not working, hence the approach)
    $mainquery = "INSERT INTO " . $tableName . "(" . $stringColumnNames . ")" . " VALUES (" . $stringInsertData . ");";

    $insertstatement = $GLOBALS['$db']->prepare($mainquery);
    $insertstatement->execute();
    $insertstatement->closeCursor();

    echo('<div>a'.$mainquery. '</div>');
    }
?>
<div>hello</div>
