<?php
// include database connection file
include_once("koneksi.php");
 
// Get id from URL to delete that user
$IDJADWAL = $_GET['IDJADWAL'];
 
// Delete user row from table based on given id
$result = mysqli_query($mysqli, "DELETE FROM jadwal_pelajaran WHERE IDJADWAL=$IDJADWAL");
 
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php");
?>
