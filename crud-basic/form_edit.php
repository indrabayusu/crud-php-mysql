<?php
  include("koneksi.php");

  if (isset($_POST["submit"])) {

    if ($_POST["submit"]=="Edit") {
        $id = htmlentities(strip_tags(trim($_POST["id"])));
        $id = mysqli_real_escape_string($koneksi,$id);

        $query = "SELECT * FROM produk WHERE id='$id'";
        $result = mysqli_query($koneksi, $query);

        if(!$result){
            die ("Query Error: ".mysqli_errno($koneksi).
                " - ".mysqli_error($koneksi));
        }

        $data = mysqli_fetch_assoc($result);

        $nama_produk  = $data["nama_produk"];
        $keterangan   = $data["keterangan"];
        $harga        = $data["harga"];
        $jumlah       = $data["jumlah"];

        mysqli_free_result($result);
    } else if ($_POST["submit"]=="Update Data") {
        $id          = htmlentities(strip_tags(trim($_POST["id"])));
        $nama_produk  = htmlentities(strip_tags(trim($_POST["nama_produk"])));
        $keterangan   = htmlentities(strip_tags(trim($_POST["keterangan"])));
        $harga        = htmlentities(strip_tags(trim($_POST["harga"])));
        $jumlah       = htmlentities(strip_tags(trim($_POST["jumlah"])));
    }
    
    if ($_POST["submit"]=="Update Data") {

        include("koneksi.php");
  
        $id          = mysqli_real_escape_string($koneksi,$id);
        $nama_produk  = mysqli_real_escape_string($koneksi,$nama_produk);
        $keterangan   = mysqli_real_escape_string($koneksi,$keterangan);
        $harga        = mysqli_real_escape_string($koneksi,$harga);
        $jumlah       = mysqli_real_escape_string($koneksi,$jumlah);
  
        $query  = "UPDATE produk SET nama_produk = '$nama_produk', keterangan = '$keterangan', harga = '$harga', jumlah='$jumlah' WHERE id = '$id'";
  
        $result = mysqli_query($koneksi, $query);
  
        if($result) {
          header("Location: tampil_produk.php");
        }
        else {
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
             " - ".mysqli_error($koneksi));
        }
      }
  } else {
    header("Location: edit_produk.php");
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
        <h3 class="text-center mt-5">Edit Produk</h3>
        <form id="form_produk" action="form_edit.php" method="post">
            <!-- Input -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="id" type="text" class="form-control" placeholder="ID Produk tidak bisa diubah di menu edit" id="id" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="nama_produk" type="text" class="form-control" placeholder="Nama Produk" value="<?=$nama_produk;?>" id="nama-produk">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <textarea name="keterangan" id="pesan" class="form-control" rows="7" placeholder="Keterangan produk lebih lanjut" value="<?=$keterangan;?>"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="harga" type="text" class="form-control" placeholder="Harga Produk (contoh: Rp. 15.000)" id="harga" value="<?=$harga;?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="jumlah" type="text" class="form-control" placeholder="Jumlah Produk" id="jumlah" value="<?=$jumlah;?>">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" value="Update Data" class="btn btn-primary" name="submit"><i class="fas fa-pen"></i> Edit Produk</button>
            <button type="reset" class="btn btn-danger"><i class="fas fa-redo-alt"></i> Reset Form</button>
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
