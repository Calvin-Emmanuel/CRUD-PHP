<?php 
//Connect to driver
$dbcon =  mysqli_connect("localhost","root","","phpdasar");

//Query table data
function query ($sql){
    global $dbcon;
    $result = mysqli_query($dbcon, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)):
        $rows[] = $row;
    endwhile;
    return $rows;
}

//function to create new rows
function tambah ($add){
    global $dbcon;
    
    //transfer data from $_POST into individual variables
    $title =htmlspecialchars($add["title"]);
    $length =htmlspecialchars($add["length"]);
    $genre =htmlspecialchars($add["genre"]);
    $author =htmlspecialchars($add["author"]);
    $publisher =htmlspecialchars($add["publisher"]);

    //upload the cover
    $cover = upload();
    if (!$cover){
        return false;
    }

    //insert the individual variables into the table
    $query = "INSERT INTO bookslist VALUES
    ('','$title','$length','$genre','$author','$publisher','$cover')
    ";
    mysqli_query($dbcon,$query);

    return mysqli_affected_rows($dbcon);
}


//function to upload image files
function upload(){
    $fileName = $_FILES["cover"]["name"];
    $fileSize = $_FILES["cover"]["size"];
    $error = $_FILES["cover"]["error"];
    $tmp = $_FILES["cover"]["tmp_name"];

    //check if a picture is uploaded
    if ($error === 4){
        echo "
            <script>
                alert('Pilihlah sebuah gambar')
            </script>
        ";
        return false;
    }
    $validFileExtensions = ["jpg","jpeg","png"];
    $fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
    $fileExtension = strtolower($fileExtension);

    //check if the file extension is valid
    if (!in_array($fileExtension,$validFileExtensions)){
        echo "
            <script>
                alert('File yang anda pilih tidak didukung')
            </script>
        ";
        return false;
    }
    
    //check if the file size is too big (limited to 2.5 MB)
    if ($fileSize>2500000){
        echo "
            <script>
                alert('File yang anda pilih terlalu besar (Maksimal 2.5 MB)')
            </script>
        ";
        return false;
    }

    //the file is valid
    //give a unique id to the file
    $newFileName = uniqid();
    $newFileName .= ".";
    $newFileName .= $fileExtension;
    //upload the file
    move_uploaded_file($tmp,"img/".$newFileName);
    return $newFileName;
}

//function to delete rows
function hapus($del){
    global $dbcon;
    mysqli_query($dbcon,"DELETE FROM bookslist WHERE id = $del");
    return mysqli_affected_rows($dbcon);
}

//function to update row data
function ubah($ubh){
    global $dbcon;

    //update data with most recent user input
    $id = (int)$ubh["id"];
    $title =htmlspecialchars($ubh["title"]);
    $length =htmlspecialchars($ubh["length"]);
    $genre =htmlspecialchars($ubh["genre"]);
    $author =htmlspecialchars($ubh["author"]);
    $publisher =htmlspecialchars($ubh["publisher"]);

    //check if a new cover/image has been submitted
    //if no, keep current cover, if yes, upload the new cover
    $currentCover =$ubh["currentCover"];
    if ($_FILES["cover"]["error"] === 4){
        $cover = $currentCover;
    } else {
        $cover = upload();
    }
    
    $query = "UPDATE bookslist SET
            title = '$title',
            length = '$length',
            genre = '$genre',
            author = '$author',
            publisher = '$publisher',
            cover = '$cover'
          WHERE id = $id";
    mysqli_query($dbcon,$query);

    return mysqli_affected_rows($dbcon);
}

function cari($keyword){
    $query = "SELECT * FROM bookslist WHERE
            title LIKE '%$keyword%' OR
            author LIKE '%$keyword%' OR
            publisher LIKE '%$keyword%' OR
            genre LIKE '%$keyword%'";
    return query($query);
}


?>
