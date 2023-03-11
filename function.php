<!-- Muhammad Nur Taufiq (L200190085) -->
<?php
    $conn = mysqli_connect('localhost', 'root', '', 'UASPrakPWD');
    function register(){
        global $conn;

        $username = strtolower($_POST['user']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm = mysqli_real_escape_string($conn, $_POST['confirm']);
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)){
            echo "<script>
                alert('username telah terdaftar!')
            </script>";
            return false;
        }

        if ($password !== $confirm){
            echo "<script>
                alert('konfirmasi password salah!')
            </script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");
        return mysqli_affected_rows($conn);
    }
?>