<!-- Muhammad Nur Taufiq (L200190085) -->
<!DOCTYPE html>
<html>
    <head>
        <title>Aplikasi Guestbook || Admin</title>
    </head>
    <body>
        <?php
            $koneksi = mysqli_connect("localhost","root","","UASPrakPWD");
            function tambah($koneksi){
                if (isset($_POST['btn_simpan'])){
                    $id = time();
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $date = $_POST['date'];
                    $message = $_POST['message'];
                    $query="INSERT INTO guestbook SET id='$id', name='$name', email = '$email', address='$address', date = '$date', message = '$message'";
                    mysqli_query($koneksi, $query);
                }
        ?> 
        <h1>Admin Page</h1>
        <button><a href="logout.php">Logout</a></button>
        <?php
        }
        function tampil_data($koneksi){
            $sql = "SELECT * FROM guestbook";
            $query = mysqli_query($koneksi, $sql);
            echo "<fieldset>";
            echo "<legend><h2>Guestbook Data</h2></legend>";
            echo "<table border='1' cellpadding='10'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>";
            while($data = mysqli_fetch_array($query)){
        ?>    
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['address']; ?></td>
                <td><?php echo $data['date']; ?></td>
                <td><?php echo $data['message']; ?></td>
                <td>
                    <a href="index.php?aksi=update&id=<?php echo $data['id']; ?>&name=<?php echo $data['name']; ?>&email=<?php echo $data['email']; ?>&address=<?php echo $data['address']; ?>&date=<?php echo $data['date']; ?>">Edit</a> |
                    <a href="index.php?aksi=delete&id=<?php echo $data['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php
            }
            echo "</table>";
            echo "</fieldset>";
        }

    function ubah($koneksi){
        if(isset($_POST['btn_ubah'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $date = $_POST['date'];
            $message = $_POST['message'];

            if(!empty($name) && !empty($email) && !empty($address) && !empty($date) && !empty($message)){
                $perubahan = "id = '$id', name = '$name', email = '$email', address = '$address', date = '$date', message = '$message'";
                $sql_update = "UPDATE guestbook SET ".$perubahan." WHERE id = $id";
                $update = mysqli_query($koneksi, $sql_update);
                if($update && isset($_GET['aksi'])){
                    if($_GET['aksi'] == 'update'){
                        header('location: index.php');
                    }
                }
            }
            
            else {
                $pesan = "Incomplete data!";
            }
        }

        if(isset($_GET['id'])){
    ?>
        <a href="index.php"> &laquo; Home</a> | 
        <a href="index.php?aksi=create"> (+) Add Data</a>
        <hr>
        <form method="POST" action="">
            <fieldset>
                <legend><h2>Edit Data</h2></legend>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
                <label>Nama : <input type="text" name="name" value="<?php echo $_GET['name'] ?>"/></label>
                <br><br>
                <label>Email : <input type="text" name="email" value="<?php echo $_GET['email'] ?>"/></label>
                <br><br>
                <label>Address : <input type="text" name="address" value="<?php echo $_GET['address'] ?>"/></label>
                <br><br>
                <label>Date : <input type="date" name="date" value="<?php echo $_GET['date'] ?>"/></label>
                <br><br>
                <label>Message : <input type="text" name="message" value="<?php echo $_GET['message'] ?></label>
                <br><br>
                <label>
                    <input type="submit" name="btn_ubah" value="Save Change"/> atau <a href="index.php?aksi=delete&id=<?php echo $_GET['id'] ?>"> (x) Delete Data</a>
                </label>
                <br>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
            </fieldset>
        </form>
    <?php
        }
    }

    function hapus($koneksi){
        if(isset($_GET['id']) && isset($_GET['aksi'])){
            $id = $_GET['id'];
            $sql_hapus = "DELETE FROM guestbook WHERE id = ".$id;
            $hapus = mysqli_query($koneksi, $sql_hapus);
    
            if($hapus){
                if($_GET['aksi'] == 'delete'){
                    header('location:index.php');
                }
            }
        }
    }

    if (isset($_GET['aksi'])){
        switch($_GET['aksi']){
            case "create":
                echo '<a href="index.php"> &laquo; Home</a>';
                tambah($koneksi);
                break;
            case "read":
                tampil_data($koneksi);
                break;
            case "update":
                ubah($koneksi);
                tampil_data($koneksi);
                break;
            case "delete":
                hapus($koneksi);
                break;
            default:
                echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
                tambah($koneksi);
                tampil_data($koneksi);
        }
    }

    else {
        tambah($koneksi);
        tampil_data($koneksi);
    }
    ?>
</body>
</html>