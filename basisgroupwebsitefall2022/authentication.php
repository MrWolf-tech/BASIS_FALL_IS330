    <?php
    session_start();
    
    require_once('./backend_accounts.php');
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $account = new ReflectionClass('Account');
    $account = $account->newInstanceWithoutConstructor();

    $account->authenticateAccount($username,$password);
    $_SESSION["account"] = $account;
    header("./index.php");
    ?>