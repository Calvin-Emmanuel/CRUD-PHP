<?php

require 'Functions.php';


//check if button is pressed
if (isset($_POST["submit"])){
    
    //check if the data for page number is a number or not 
    if (isset($_POST["length"]) && !is_numeric($_POST["length"])){
        echo "
            <script>
                alert('Jumlah halaman yang anda masukkan bukan angka')
            </script>
        ";
    }
    //insert data
    //check if data insertion succeeds or not
    if (tambah($_POST)>0) {
        echo "
            <script> 
                alert('Data berhasil ditambahkan');
                document.location.href = '../Index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data GAGAL ditambahkan');
            </script>    
        ";
        echo mysqli_error($dbcon);
    }

}



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tambahkan data buku</title>
    </head>
    <body>
        <h1>Tambahkan data buku</h1>
        <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="title">Judul Buku: </label>
                <input type="text" name="title" id="title" autocomplete="off" required>
            </li>
            <li>
            <label for="length">Jumlah Halaman: </label>
            <input type="text" name="length" id="length" autocomplete="off" required>
            </li>
            <li>
            <label for="genre">Genre Buku: </label>
            <input type="text" name="genre" id="genre" autocomplete="off" required>
            </li>
            <li>
            <label for="author">Penulis Buku: </label>
            <input type="text" name="author" id="author" autocomplete="off" required>
            </li>
            <li>
            <label for="publisher">Penerbit Buku: </label>
            <input type="text" name="publisher" id="publisher" autocomplete="off" required>
            </li>
            <li>
            <label for="cover">Cover Buku: </label>
            <input type="file" name="cover" id="cover" required >
            </li>
        </ul>
            <button type="submit" name="submit">Tambah!</button>
        </form>
        <br>
        <a href="Index.php">Kembali ke halaman sebelumnya</a>
    </body>
</html>