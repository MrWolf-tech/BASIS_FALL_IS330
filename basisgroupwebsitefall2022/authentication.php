    <?php
    require_once('./backend_accounts.php');
    session_start();
    
    
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $account = new Account();
    $account->authenticateAccount($username,$password);
    $_SESSION["account"] = $account;
    header("Location: index.php");
    ?>