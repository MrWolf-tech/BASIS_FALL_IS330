<?php
    require_once('./model_account_info.php');
    require_once('./model_customers.php');
    
    class Account 
    {
        private $account_id;
        private $account_name;
        private $account_address;
        private $account_city;
        private $account_state;
        private $account_country;
        private $account_zip;
        private $account_phone_number;
        private $account_email;
        private $account_username;
        private $account_password; //only used for creating new accounts
        private $account_is_admin = false; //initialized to false by default


        const PASSWORD_ALGO = PASSWORD_BCRYPT;

        function constructor($name,$address,$city,$state,$country,$zip,$phone_number,$email,$username,$password,$is_admin){
            $this->setName($name);
            $this->setAddress($address);
            $this->setCity($city);
            $this->setState($state);
            $this->setCountry($country);
            $this->setZIP($zip);
            $this->setPhoneNumber($phone_number);
            $this->setEmail($email);
            $this->setUsername($username);
            $this->setPassword($password);
            $this->setIsAdmin($is_admin);
        }

        private function setAccountID($param){ //private because ids should auto increment
            $this->account_id = $param;
        }
        function getAccountID(){
            return $this->account_id;
        }
        
        function setName($param){
            $this->account_name = $param;
        }
        function getName(){
            return $this->account_name;
        }

        function setAddress($param){
            $this->account_address = $param;
        }
        function getAddress(){
            return $this->account_address;
        }

        function setCity($param){
            $this->account_city = $param;
        }
        function getCity(){
            return $this->account_city;
        }

        function setState($param){
            $this->account_state = $param;
        }
        function getState(){
            return $this->account_state;
        }

        function setCountry($param){
            $this->account_country = $param;
        }
        function getCountry(){
            return $this->account_country;
        }

        function setZIP($param){
            $this->account_zip = $param;
        }
        function getZIP(){
            return $this->account_zip;
        }

        function setPhoneNumber($param){
            $this->account_phone_number = $param;
        }
        function getPhoneNumber(){
            return $this->account_phone_number;
        }

        function setEmail($param){
            $this->account_email = $param;
        }
        function getEmail(){
            return $this->account_email;
        }
        
        function setUsername($param){
            $this->account_username = $param;
        }
        function getUsername(){
            return $this->account_username;
        }

        function setPassword($param){ //used for creating and updating accounts, otherwise it is not used
            $this->account_password = $param;
        }

        function setIsAdmin($param){
            $this->account_is_admin = $param;
        }
        function getIsAdmin(){
            return $this->account_is_admin;
        }
        


        /*getAccount(){ //returns account as json (implement if necessary)

        }*/
        

        function selectAccount($id){ //retrieves account from database by id
            if($id !== null){ //if id not null
            $result1 = selectCustomerOnID($id)->fetch();
            $this->setAccountID($result1[0]);
            $this->setName($result1[1]);
            $this->setAddress($result1[2]);
            $this->setCity($result1[3]);
            $this->setState($result1[4]);
            $this->setCountry($result1[5]);
            $this->setZIP($result1[6]);
            $this->setPhoneNumber($result1[7]);
            $this->setEmail($result1[8]);

            $result2 = selectAccountInfoOnID($id)->fetch();
            $this->setUsername($result1[1]);
            $this->setIsAdmin($result1[3]);
            }
        }

        function authenticateAccount($username, $password){ //gets account id by passed in username and password, then automatically selects this from the database, turning this account object into it
            $id = authenticateAccountInfo($username,$password);
            print $id;
            if(isset($id)){
                $this->selectAccount($id);
                return true;
            }
            else{
                return false;
            }
        }
        
        function insertAccount(){
            $whereCondition = "username = :dataValue0";
            $dataValueArray = array($this->account_username);

            if(selectData($GLOBALS['account_infoTableName'], $whereCondition, $dataValueArray)->rowCount() == 0){ //checks if the username already exists, should be modified to tell user if username exists

                insertCustomer($this->account_name, $this->account_address, $this->account_city, $this->account_state, $this->account_country, $this->account_zip, $this->account_phone_number, $this->account_email);

                $this->account_id = $GLOBALS['$db']->lastInsertId();
                if($this->account_id !== null){
                    return insertAccountInfo($this->account_id, $this->account_username, $this->account_password, $this->account_is_admin);

                }
            }
        }

        function updateAccount(){ //modifies account in database except for password NOT FINISHED
            updateAccountUsernameOnID($this->account_id, $this->account_username);
                
            }
        
    }
?>