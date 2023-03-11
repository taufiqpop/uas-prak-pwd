<!-- Muhammad Nur Taufiq (L200190085) -->
<?php
    session_start();
    $_SESSION=[];
    session_unset();
    session_destroy();
    setcookie('login','', time()-36000);
    header("Location: login.php");
    exit;
?>