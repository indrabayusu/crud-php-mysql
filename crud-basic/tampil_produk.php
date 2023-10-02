<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <title>CRUD Basic | ibee</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("navbar.php"); ?>
    <br><br><br>
    <div class="container-fluid p-2">
        <table class="table table-hover"> 
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
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
                echo "</tr>";
                }
                
                mysqli_free_result($result);
                
                mysqli_close($koneksi);
            ?>
        </table>
    </div>
            
    <?php include("footer.php");?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>