
    <?php 
    require_once('./database_functions.php');
    $columnNames = array('customer_id','name','address','city','state','country','zip','phone_number','email');
    $tableName = 'customers';

    if(count($_POST) != 0){ //if _post array is not empty
        $search_value = filter_input(INPUT_POST, 'search_value'); 
        $column_number = filter_input(INPUT_POST, 'column_number');
        $operation_type = filter_input(INPUT_POST, 'operation_type');
    
    
        if($operation_type == 1){ // if deleteoperation
            $result = deleteCustomer($column_number, $search_value)->rowCount();
            echo($result . ' Rows Deleted');
            //echo($search_value);
        }
        if($operation_type == 0){ // if select operation
            $returned_value = selectCustomer($column_number, $search_value);
            $results = $returned_value->fetchAll();
            echo('<table>');
            foreach($results as $row)
            {
                echo('<tr>');
                foreach($row as $print){
                    echo("<th>$print</th>");
                    }
                echo('</tr>');
            }
            echo('</table>');
        }
        
    }



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
    //echo('<br/>'.$result1[0][1]);
    
    //$result = selectJoinData($tableName, 'customer_id', 'account_info', 'customer_id');
    
    
    

    //deleteDataOnKey('name','2',$tableName);
    //updateDataOnkey('name','John PHP', $tableName, $inputColumnArray, $inputDataArray3);
    //header('.'); //redirects to self purge post array
    ?>
    <form id="addpersonForm" method="post" action="" name="addPersonForm"> <!-- this form is for adding and deleting people-->
        <h1 class='formName'>Select Customer</h1>
        <input type="text"  id="search_value" name="search_value" placeholder="Value"/>
        <select id="column" name="column_number">
            <option SELECTED value="0">customer_id</option>
            <option value="1">name</option>
            <option value="2">address</option>
            <option value="3">city</option>
            <option value="4">state</option>
            <option value="5">country</option>
            <option value="6">zip</option>
            <option value="7">phone_number</option>
            <option value="8">email</option>
        </select>
        
        <br/>
        <select id="operation_type" name="operation_type">
            <option SELECTED value="0">Select</option>
            <option value="1">Delete</option>
            <?php if($operation_type == 0){
                echo('<option value="2">Update</option>');
             } ?>
        </select>
        <!--<input type="hidden" value='<?php// echo($results[]) ?>'/>-->
        <input type="submit"  id="person_submit" name="Submit"/>
    </form>