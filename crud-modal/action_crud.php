<?php
    include ('koneksi.php');

if (isset($_POST['tambahDataUser'])) {

    $cekDataAkun = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE nama_user='$_POST[nama_user]' or username='$_POST[username]'"));
    
if ($cekDataAkun > 0) {
    echo "<script>
            alert('Data user sudah ada!');
            document.location.href = 'index.php';  
        </script>";
} else {

    global $koneksi;

    $id_user   = ($_POST['id_user']);
    $nama_user = ($_POST['nama_user']);
    $username  = ($_POST['username']);
    $password  = ($_POST['password']);
    $role      = ($_POST['role']);

    $tambahDataUser = "INSERT INTO users VALUES('$id_user', '$nama_user', '$username', '$password', '$role')";

    mysqli_query($koneksi, $tambahDataUser);

        echo "<script>
                alert('Data user berhasil dibuat!');
                document.location.href = 'index.php';  
            </script>";
    }
}

if (isset($_POST['ubahDataUser'])) {

    global $koneksi;

    $id_user   = ($_POST['id_user']);
    $nama_user = ($_POST['nama_user']);
    $username  = ($_POST['username']);
    $password  = ($_POST['password']);
    $role      = ($_POST['role']);

    $ubahDataUser = "UPDATE users SET nama_user ='$nama_user', username ='$username', password ='$password', role ='$role' WHERE id_user = '$id_user'";

    mysqli_query($koneksi, $ubahDataUser);

if ($ubahDataUser) {
    echo "<script>
            alert('Data user berhasil diubah!');
            document.location='index.php';
        </script>";
} else {
    echo "<script>
            alert('Data user gagal diubah!');
            document.location='index.php';
        </script>";
    }
}

if (isset($_POST['hapusDataUser'])) {

    $hapusDataUser = mysqli_query($koneksi, "DELETE FROM users WHERE id_user = '$_POST[id_user]' ");

if ($hapusDataUser) {
    echo "<script>
            alert('Data user berhasil dihapus!');
            document.location='index.php';
        </script>";
} else {
    echo "<script>
            alert('Data user gagal dihapus!');
            document.location='index.php';
        </script>";
    }
}

?>