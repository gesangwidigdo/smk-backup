<?php
    session_start();
    if (!isset($_SESSION["id_admin"])) {
        header("location:login_admin.php");
    }
    include("config.php");
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>GNG Admin</title>
     <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
     <script src="
     ../assets/js/jquery.min.js"></script>
     <script src="../assets/js/popper.min.js"></script>
     <script src="../assets/js/bootstrap.js"></script>

     <script>
        Add = () =>{
            document.getElementById('action').value = "insert";
            document.getElementById('id_admin').value = "";
            document.getElementById('nama').value = "";
            document.getElementById('kontak').value = "";
            document.getElementById('username').value = "";
            document.getElementById('password').value = "";
        }

        Edit = (item) =>{
            document.getElementById('action').value = "update";
            document.getElementById('id_admin').value = item.id_admin;
            document.getElementById('nama').value = item.nama;
            document.getElementById('kontak').value = item.kontak;
            document.getElementById('username').value = item.username;
            document.getElementById('password').value = item.password;
        }
     </script>
 </head>
 <body>    
     <?php
         if (isset($_POST["search"])) {
             $search = $_POST["search"];
             $sql = "select * from admin where id_admin like '%$search%' or nama like '%$search%' or kontak like '%$search%' or username like '%$search%'";
         }else{
             $sql = "select * from admin";
         }

         $query = mysqli_query($connect, $sql);
      ?>
        <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php" style="color: white;">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer.php" style="color: white;">Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bookstore.php" style="color: white;">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a href="histori_transaksi.php" class="nav-link" style="color: white;">Data Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="proses_login_admin.php?logout=true" style="color: white">Logout</a>
                        <!-- <?php echo $_SESSION["nama"]; ?> -->
                    </li>   
                </ul>
                <form class="form-inline my-2 my-lg-0" action="admin.php" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" id="search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    <br>

      <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h1>Data Admin</h1>
            </div>
            <div class="card-body">
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <th>ID Admin</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($query as $admin): ?>
                            <tr>
                                <td><?php echo $admin["id_admin"]?></td>
                                <td><?php echo $admin["nama"]?></td>
                                <td><?php echo $admin["kontak"]?></td>
                                <td><?php echo $admin["username"]?></td>
                                <td><?php echo $admin["password"]?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#modal_admin" type="button"
                                    class="btn btn-sm btn-info" onclick='Edit(<?php echo json_encode($admin);?>)'>
                                        Edit
                                    </button>
                                    <a href="crud_admin.php?hapus=true&id_admin=<?php echo $admin["id_admin"]?>"
                                    onclick="return confirm('Apakah anda yakin menghapus item ini?')">
                                        <button type="button" class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary float-right" style="margin-left: 15px;" data-toggle="modal"
                data-target="#modal_admin" onclick="Add()">Tambah Data</button>
            </div>
            <div class="card-footer text-center">
                <p>&copy;2020 <br> MGesangRW</p>
            </div>
        </div>

        <div class="modal fade" id="modal_admin">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="crud_admin.php" method="post">
                        <div class="modal-header bg-primary text-white">
                            <h4>Modal Admin</h4>
                            <span class="close" data-dismiss="modal">&times;</span>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" id="action">
                            ID Admin <span style="color: red;">*</span>
                            <input type="number" name="id_admin" id="id_admin" class="form-control" required />
                            Nama <span style="color: red;">*</span>
                            <input type="text" name="nama" id="nama" class="form-control" required />
                            Kontak <span style="color: red;">*</span>
                            <input type="number" name="kontak" id="kontak" class="form-control" required />
                            Username <span style="color: red;">*</span>
                            <input type="text" name="username" id="username" class="form-control" required />
                            Password <span style="color: red;">*</span>
                            <input type="password" name="password" id="password" class="form-control" required />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="save_admin">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
 </body>
 </html>