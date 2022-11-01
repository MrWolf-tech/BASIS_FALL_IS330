
    <?php 
    



    
    //echo('<br/>'.$result1[0][1]);
    
    //$result = selectJoinData($tableName, 'customer_id', 'account_info', 'customer_id');
    
    
    

    //deleteDataOnKey('name','2',$tableName);
    //updateDataOnkey('name','John PHP', $tableName, $inputColumnArray, $inputDataArray3);
    //header('.'); //redirects to self purge post array
    ?>
    <form id="addpersonForm" method="post" name="addPersonForm" action="./update_customer.php"> <!-- this form is for adding and deleting people-->
        <h1 class='formName'>Select Customer</h1>
        <label for="search_value">Customer_ID:</label>
        <input type="text"  id="search_value" name="search_value" placeholder="Value"/>
        
        <br/>
        <!--<input type="hidden" value='<?php// echo($results[]) ?>'/>-->
        <input type="submit"  id="person_submit" name="Submit"/>
    </form>