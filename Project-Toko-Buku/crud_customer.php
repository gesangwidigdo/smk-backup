<?php
    include("config.php");
    if (isset($_POST["save_customer"])) {
        $action = $_POST["action"];
        $id_customer = $_POST["id_customer"];
        $nama = $_POST["nama"];
        $alamat = $_POST["alamat"];
        $kontak = $_POST["kontak"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($action == "insert") {
            $sql = "insert into customer values ('$id_customer', '$nama', '$alamat', '$kontak', '$username', '$password')";
        }elseif ($action == "update") {
            $sql = "update customer set id_customer='$id_customer',
                    nama='$nama', alamat='$alamat', kontak='$kontak',
                    username='$username', password='$password'
                    where id_customer='$id_customer'";
        }
        $query = mysqli_query($connect, $sql);
        header("location:customer.php");
    }

    if (isset($_GET["delete"])) {
        $id_customer = $_GET["id_customer"];
        // delete process
        $sql = "select * from customer where id_customer='$id_customer'";
        $query = mysqli_query($connect, $sql);
        $sql = "delete from customer where id_customer='$id_customer'";
        $query = mysqli_query($connect, $sql);

        header("location:customer.php");
    }
 ?>