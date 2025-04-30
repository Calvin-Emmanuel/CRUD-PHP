<?php 
require 'Functions.php';

//receive information regarding which row is being updated
$id = $_GET["id"];

//query the selected row
$book = query("SELECT * FROM bookslist WHERE id = $id")[0];


//check if button is pressed
if (isset($_POST["submit"])){
   

    //check if data update succeeds or not
    if (ubah($_POST)>0) {
        echo "
            <script> 
                alert('Data berhasil diubah');
                document.location.href = '../Index.php';
            </script>
        ";
    } else {
        echo "<script> 
                alert('Data GAGAL diubah');
            </script>
            mysqli_error($dbcon)
                ";
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ubah data buku</title>
    </head>
    <body>
        <h1>Ubah data buku</h1>
        <form action="" method="post" enctype="multipart/form-data">
        <ul>
                <input type="hidden" name="id" value="<?= $book["id"]?>">
                <input type="hidden" name="currentCover" value="<?= $book["cover"]?>">
            <li>
                <label for="title">Judul Buku: </label>
                <input type="text" name="title" id="title"  value="<?= $book["title"]?>" required>
            </li>
            <li>
            <label for="length">Jumlah Halaman: </label>
            <input type="text" name="length" id="length" value="<?= $book["length"]?>" required>
            </li>
            <li>
            <label for="genre">Genre Buku: </label>
            <input type="text" name="genre" id="genre" value="<?= $book["genre"]?>" required>
            </li>
            <li>
            <label for="author">Penulis Buku: </label>
            <input type="text" name="author" id="author" value="<?= $book["author"]?>" required>
            </li>
            <li>
            <label for="publisher">Penerbit Buku: </label>
            <input type="text" name="publisher" id="publisher" value="<?= $book["publisher"]?>" required>
            </li>
            <li>
            <label for="cover">Cover Buku: </label> <br>
            <img src="img/<?= $book["cover"]?>"> <br>   
            <input type="file" name="cover" id="cover">
            </li>
        </ul>
            <button type="submit" name="submit">Ubah!</button>
        </form>
        <br>
        <a href="Index.php">Kembali ke halaman sebelumnya</a>
    </body>
</html>