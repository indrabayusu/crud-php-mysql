<?php
  include("koneksi.php");

  if (isset($_POST["submit"])) {

    $id          = htmlentities(strip_tags(trim($_POST["id"])));
    $id           = mysqli_real_escape_string($koneksi,$id);

    $query = "DELETE FROM produk WHERE id='$id' ";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <title>CRUD Basic | ibee</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <style>
        button {
            outline: none;
            border: 3px solid blue;
            border-radius: 7px;
            color: blue;
            background-color: transparent;
            cursor: pointer;
        }

        button:hover {
            background-color: blue;
            color: #fff;
            transition: all .4s ease;
        }
    </style>
</head>
<body>
    <?php include("navbar.php"); ?>
    <br><br><br>
    <div class="container-fluid p-2 m-2">
        <table class="table table-hover"> 
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Edit Produk</th>
                </tr>
            </thead>
            <?php
                include("koneksi.php");
        
                $query  = "SELECT * FROM produk ORDER BY id ASC";
                $result = mysqli_query($koneksi, $query);
                
                if(!$result){
                    die ("Query Error: ".mysqli_errno($koneksi).
                        " - ".mysqli_error($koneksi));
                }
                
                while($data = mysqli_fetch_assoc($result))
                { 
                echo "<tr>";
                echo "<td>$data[id]</td>";
                echo "<td>$data[nama_produk]</td>";
                echo "<td>$data[keterangan]</td>";
                echo "<td>$data[harga]</td>";
                echo "<td>$data[jumlah]</td>";
                echo "<td>";
            ?>
            <form action="form_edit.php" method="post">
                <input type="hidden" name="id" value="<?php echo "$data[id]";?>">
                <button type="submit" value="Edit" name="submit"><i class="fas fa-pen"></i></button>
            </form>
            <?php
                echo "</td>";
                echo "</tr>";
                }
            ?>
        </table>
    </div>
            
    <?php include("footer.php");?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>