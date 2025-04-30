<?php 
require 'Functions.php';

//receive information regarding which row is being deleted
$del = $_GET["id"];

//delete data
//check if row deletion succeeds or not
if (hapus($del)>0){
    echo "
            <script> 
                alert('Data berhasil dihapus');
                document.location.href = '../Index.php';
            </script>
        ";
} else {
    echo "alert('Data GAGAL dihapus');
            ";
    echo mysqli_error($dbcon);
}
?>