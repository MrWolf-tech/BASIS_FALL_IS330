<?php
    session_start();
    
    require_once('./backend_accounts.php');
    $_SESSION["account"] = null;
    
    header("Location: index.php");
    ?>