    <?php
    require_once('./backend_accounts.php');
    session_start();
    
    
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $account = new Account();
    if($account->authenticateAccount($username,$password)){
        $_SESSION["account"] = $account;
        print("<p>Authentication Successful</p><a href='loginpage.php'>Return to Login</a>");
        header("Location: index.php");
    }
    else{
        print("<p>Authentication Failed</p><a href='loginpage.php'>Return to Login</a>");
    }
    ?>