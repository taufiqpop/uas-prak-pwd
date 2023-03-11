<!-- Muhammad Nur Taufiq (L200190085) -->
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <?php
            session_start();
            if(isset($_COOKIE['login'])){
                if ($_COOKIE['login'] == 'true'){
                    $_SESSION['login'] = true;
                }
            }

            if(isset($_SESSION['login'])){
                header("Location:index.php");
                exit;
            }
            require '../function.php';

            if (isset($_POST['login'])){
                $username = $_POST['user'];
                $password = $_POST['pass'];
                $result = mysqli_query($conn, "select * from user where username = '$username'");
    
                if (mysqli_num_rows($result) === 1){
                    $row = mysqli_fetch_assoc($result);
                    if(password_verify($password, $row['password'])){
                        $_SESSION['login'] = true;
                        if(isset($_POST['remember'])){
                            setcookie('login', 'true', time()+60);
                        }
                        header(("Location:index.php"));
                        exit;
                    }
                }
                $error = true;
            }
        ?>
    </head>
    <body>
        <center>
            <h1>Login Page</h1>
            <?php if(isset($error)): ?>
                <p style="color: red; font-style: italic;">ID/Password was wrong!</p>
            <?php endif; ?>
            <form method="POST" action="">
                <h3>ID : <br><input type="text" name="user"></h3>
                <h3>Password : <br><input type="password" name="pass"></h3>
                <input type="submit" name="login" value="Login">
            </form>
        </center>
    </body>
</html>