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
        private $account_password;


        define(PASSWORD_ALGO,"PASSWORD_BCRYPT");

        function __construct($name,$address,$city,$state,$country,$zip,$phone_number,$email,$username,$password){
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
        }
        
        function setName($param){
            $account_name = $param;
        }
        function getName(){
            return $account_name;
        }

        function setAddress($param){
            $account_address = $param;
        }
        function getAddress(){
            return $account_address;
        }

        function setCity($param){
            $account_city = $param;
        }
        function getCity(){
            return $account_city;
        }

        function setState($param){
            $account_state = $param;
        }
        function getState(){
            return $account_state;
        }

        function setCountry($param){
            $account_country = $param;
        }
        function getCountry(){
            return $account_country;
        }

        function setZIP($param){
            $account_zip = $param;
        }
        function getZIP(){
            return $account_zip;
        }

        function setPhoneNumber($param){
            $account_phonenumber = $param;
        }
        function getPhoneNumber(){
            return $account_phonenumber;
        }

        function setEmail($param){
            $account_email = $param;
        }
        function getEmail(){
            return $account_email;
        }
        
        function setUsername($param){
            $account_username = $param;
        }
        function getUsername(){
            return $account_username;
        }

        function setPasswordHash($param){
            $account_password = $param;
        }
        function getPasswordHash(){
            return $account_password;
        }

        function setPassword($param){ //sets the password hash to the hash of inputted parameter
            $account_password = password_hash($param, PASSWORD_ALGO);
        }

        /*getAccount(){ //returns account as json (implement if necessary)

        }*/

        function selectAccount(){ //retrieves account from database
            
        }
        function updateAccount(){ //modifies account in database
            
        }
        
    }
?>