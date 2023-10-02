<?php
    session_start();

    include ('koneksi.php');

    $auto       = mysqli_query($koneksi, "SELECT max(id_user) as max_code from users");
    $data       = mysqli_fetch_array($auto);
    $code       = $data['max_code'];
    $huruf      = "ID";
    $urutan     = (int) substr($code, 2, 3);
    $urutan++;
    $id_user    = $huruf . sprintf("%02s", $urutan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CRUD with Modal | ibee</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("navbar.php"); ?>
    <br><br>

    <div class="card-body">

    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambahDataUser" style="margin: 10px auto;"><i class="fa fa-plus"></i> Tambah Data </button>

        <table id="example2" class="table table-bordered table-hover">
            <thead class="thead-dark">
            <tr>
                <th width="50">ID</th>
                <th>Nama</th>
                <th>Username</th>
                <th width="150">Role</th>
                <th style="text-align: center;" width="250">Aksi</th>
            </tr>
            </thead>
            <tbody>

            <?php 
            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id_user ASC");
            while ($data = mysqli_fetch_array($tampil)) :
            ?>

            <tr>
                <td><?= $data['id_user']; ?></td>
                <td><?= $data['nama_user']; ?></td>
                <td><?= $data['username']; ?></td>
                <td><?= $data['role']; ?></td>
                <td align="center">
                <button type="button" class="btn btn-sm btn-success" style="margin: 2px auto;" data-toggle="modal" data-target="#modalUbahDataUser<?= $data['id_user']; ?>"><i class="fas fa-edit"></i> Ubah </button>
                <button type="button" class="btn btn-sm btn-danger" style="margin: 2px auto;" data-toggle="modal" data-target="#modalHapusDataUser<?= $data['id_user']; ?>"><i class="fas fa-trash-alt"></i> Hapus </button>
                </td>
            </tr>

            <!-- Modal Ubah Data User -->
            <div class="modal fade" id="modalUbahDataUser<?= $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog .modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="exampleModalScrollableTitle" style="padding-left: 125px;">Form Ubah Data User</h5>
                        </div>
                    <div class="modal-body">
                        <form method="POST" action="action_crud.php">
                            <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="nama_user" value="<?= $data['nama_user']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" value="<?= $data['username']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" minlength="6" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                    <select name="role" class="form-control" required>
                                        <?php $role = $data['role']; ?>
                                        <option value="Admin" <?= $role == 'Admin' ? 'selected' : null ?>>Admin</option>
                                        <option value="Karyawan" <?= $role == 'Karyawan' ? 'selected' : null ?>>Karyawan</option>
                                    </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="ubahDataUser" class="btn btn-success">Ubah</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Ubah Data User -->

            <!-- Modal Hapus Data User -->
            <div class="modal fade" id="modalHapusDataUser<?= $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="exampleModalLabel" style="padding-left: 110px;">Konfirmasi Hapus Data User</h5>
                        </div>
                    <div class="modal-body">
                        <form method="POST" action="action_crud.php">
                            <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">
                                <p class="text-center">Apakah anda yakin ingin menghapus data user : <br>
                                <span class="text-danger"><?= $data['nama_user']; ?></span> ?</p>
                            <div class="modal-footer">
                                <button type="submit" name="hapusDataUser" class="btn btn-danger"> Hapus </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Tutup </button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Hapus Data User -->
            <?php endwhile; ?>

            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Data User -->
    <div class="modal fade" id="modalTambahDataUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog .modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalScrollableTitle" style="padding-left: 125px;">Form Tambah Data User</h5>
                </div>
                <form method="POST" action="action_crud.php">
                    <div class="modal-body">
                    <div class="form">
                        <div class="mb-3">
                            <label for="id_user">Id</label>
                            <input type="text" name="id_user" class="form-control" value="<?= $id_user ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="name">Nama</label>
                            <input type="text" name="nama_user" class="form-control" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" minlength="6" required>
                        </div>
                        <div class="mb-3">
                            <label for="role">Role</label>
                                <select name="role" class="form-control">
                                    <option>Admin</option>
                                    <option>Karyawan</option>
                                </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="tambahDataUser" class="btn btn-primary"> Tambah </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Tutup </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Data User -->
</div>

<div class="bottom-table"></div>
    
<!-- Footer -->
    <?php include("footer.php");?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": true
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>
</html>