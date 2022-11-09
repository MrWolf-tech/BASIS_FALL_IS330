<?php 
    session_start();

    require_once('./model_customers.php');
    
    $columnNames = array('customer_id','name','address','city','state','country','zip','phone_number','email');//list of names for labels
    //$tableName = 'customers';

    ?>
    
    
    <form id="addpersonForm" method="post" name="addPersonForm" action="update_customer_execute.php">
    
        <?php
        if(count($_POST) != 0){ //if _post array is not empty
            $search_value = filter_input(INPUT_POST, 'search_value'); 
            $returned_value = selectCustomerOnID($search_value);
            $results = $returned_value->fetch();
            $_SESSION["update_id"] = $results[0];

            for($i = 0; $i < count($results); $i++){ //creates a label and  input for each column in the customers table
                if($i == 0){
                    echo("<label for='$i'>$columnNames[$i]</label> <b> $results[$i] </b>");
                }
                else{
                    echo("<label for='$i'>$columnNames[$i]</label><input type='text' name='$columnNames[$i]' id='$i' value='$results[$i]''></input>");
                    }

            }
        }
        else{
            header("./update_customer_select.php");
        }
        ?>
        <input type="submit"  id="person_submit" name="Submit" />
    </form>