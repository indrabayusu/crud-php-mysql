<?php
  include("koneksi.php");

  if (isset($_POST["submit"])) {
    $id           = htmlentities(strip_tags(trim($_POST["id"])));
    $nama_produk  = htmlentities(strip_tags(trim($_POST["nama_produk"])));
    $keterangan   = htmlentities(strip_tags(trim($_POST["keterangan"])));
    $harga        = htmlentities(strip_tags(trim($_POST["harga"])));
    $jumlah       = htmlentities(strip_tags(trim($_POST["jumlah"])));

    $id           = mysqli_real_escape_string($koneksi,$id);
    $nama_produk  = mysqli_real_escape_string($koneksi,$nama_produk );
    $keterangan   = mysqli_real_escape_string($koneksi,$keterangan);
    $harga        = mysqli_real_escape_string($koneksi,$harga);
    $jumlah       = mysqli_real_escape_string($koneksi,$jumlah);

    $query = "INSERT INTO produk VALUES ";
    $query .= "('$id', '$nama_produk', '$keterangan', '$harga','$jumlah')";

    $result = mysqli_query($koneksi, $query);

    if($result) {
        header("Location: tampil_produk.php");
      }
      else {
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }
    }
 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>CRUD Basic | ibee</title>
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <style type="text/css">
      h3.text-center {
        padding-top: 25px;
      }
  </style>
</head>
<body>
    <?php include("navbar.php"); ?>
    <div class="container mt-5">
        <h3 class="text-center mt-5">Tambah Produk</h3>
        <form id="form_produk" action="tambah_produk.php" method="post">
            <!-- Input -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="id" type="number" class="form-control" placeholder="ID Produk (contoh: 1234)" id="id">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="nama_produk" type="text" class="form-control" placeholder="Nama Produk" id="nama-produk">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <textarea name="keterangan" id="pesan" class="form-control" rows="7" placeholder="Keterangan produk lebih lanjut"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="harga" type="text" class="form-control" placeholder="Harga Produk (contoh: Rp. 15.000)" id="harga">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="jumlah" type="number" class="form-control" placeholder="Jumlah Produk" id="telepon">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-archive"></i> Tambah Produk</button>
            <button type="reset" class="btn btn-danger"><i class="fas fa-redo-alt"></i> Clear Form</button>
        </form>
    </div>

    <?php include("footer.php");?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php
  mysqli_close($koneksi);
?>
