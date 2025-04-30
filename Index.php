<?php 
require 'Other/Functions.php';

//Query the table to be read
$books = query("SELECT * FROM bookslist");

//Check if search button has been pressed or not

if (isset($_POST["keyword"])){
    $books = cari($_POST["keyword"]);
}

// Check if search reset button has been pressed or not
if (isset($_POST["reset"])){
    $books = query("SELECT * FROM bookslist");
    unset($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Admin</title>
    </head>
    <body>
        <h1>Daftar Buku</h1>
        <a href="Other/Tambah.php">Tambahkan data buku</a>
        <br><br>

        <form action="" method="post">
            <input type="text" name="keyword" placeholder="Masukkan keyword pencarian" autocomplete="off" size="40px">
            <button type="submit" name="search">Cari</button>
            <button type="submit" name="reset">Reset Pencarian</button>
        </form>
        <?php 
            if (isset($_POST["keyword"])){
        ?>
        <p>Sekarang menunjukkan hasil pencarian <?= $_POST["keyword"]?></p>
        <?php } else{
            echo"<br>";
        }?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>No. Urut</th>
                <th>Aksi</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Genre</th>
                <th>Jumlah Halaman</th>
            </tr>
            <!-- Looping mechanism for reading table data -->
            <?php $i =1; foreach ($books as $book):?>
            <tr>
                <td><?= $i ?></td>
                <td>
                    <!-- Actions that can be done to an individual row -->
                    <a href="Other/Ubah.php?id=<?= $book["id"]?>">Ubah</a> |
                    <a href="Other/Hapus.php?id=<?= $book["id"]?>" 
                    onclick="return confirm('Apakah anda yakin anda ingin menghapus <?= $book['title']?>')">Hapus</a>
                </td>
                <td align="center"><img src="Other/img/<?= $book["cover"]?>" alt="<?= $book["cover"]?>"></td>
                <td align="center"><?= $book["title"]?></td>
                <td align="center"><?= $book["author"]?></td>
                <td align="center"><?= $book["publisher"]?></td>
                <td align="center"><?= $book["genre"]?></td>
                <td align="center"><?= $book["length"]?></td>
            </tr>
            <?php $i++;     endforeach;?>
        </table>
    </body>
</html>