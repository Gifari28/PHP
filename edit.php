<?php
// include database connection file
include_once("koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{	
	$IDJADWAL = $_POST['IDJADWAL'];
	
		$ID_GURU = $_POST['ID_GURU'];
		$KODE_MAPEL = $_POST['KODE_MAPEL'];
		$NO_INDUK = $_POST['NO_INDUK'];
		$IDRUANG = $_POST['IDRUANG'];
		$HARIJADWAL = $_POST['HARIJADWAL'];
		$SESIJADWAL = $_POST['SESIJADWAL'];
		$WAKTU_MULAI = $_POST['WAKTU_MULAI'];
		$WAKTU_SELESAI = $_POST['WAKTU_SELESAI'];
		
	// update user data
	$result = mysqli_query($mysqli, "UPDATE jadwal_pelajaran SET ID_GURU='$ID_GURU',KODE_MAPEL='$KODE_MAPEL',NO_INDUK='$NO_INDUK,IDRUANG='$IDRUANG',HARIJADWAL='$HARIJADWAL',SESIJADWAL='$SESIJADWAL',WAKTU_MULAI='$WAKTU_MULAI',WAKTU_SELESAI='$WAKTU_SELESAI' WHERE IDJADWAL=$IDJADWAL");
	
	// Redirect to homepage to display updated user in list
	header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$IDJADWAL = $_GET['IDJADWAL'];
 
// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM jadwal_pelajaran WHERE IDJADWAL=$IDJADWAL");
 
while($user_data = mysqli_fetch_array($result))
{
	$ID_GURU = $user_data['ID_GURU'];
	$KODE_MAPEL = $user_data['KODE_MAPEL'];
	$NO_INDUK = $user_data['NO_INDUK'];
	$IDRUANG = $user_data['IDRUANG'];
	$HARIJADWAL = $user_data['HARIJADWAL'];
	$SESIJADWAL = $user_data['SESIJADWAL'];
	$WAKTU_MULAI = $user_data['WAKTU_MULAI'];
	$WAKTU_SELESAI = $user_data['WAKTU_SELESAI'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>
 
<body>
	<a href="index.php">Menu Utama</a>
	<br/><br/>
	
	<form name="update_user" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>ID Guru</td>
				<td><input type="text" name="ID_GURU" value=<?php echo $ID_GURU;?>></td> ></td>
			</tr>
			<tr> 
				<td>Kode Mapel</td>
				<td><input type="text" name="KODE_MAPEL" value=<?php echo $KODE_MAPEL;?>></td>></td>
			</tr>
			<tr> 
				<td>No Induk</td>
				<td><input type="text" name="NO_INDUK" value=<?php echo $NO_INDUK;?>></td>></td>
			</tr>
			<tr> 
				<td>ID Ruang</td>
				<td><input type="text" name="IDRUANG" value=<?php echo $IDRUANG;?>></td>></td>
			</tr>
			<tr> 
				<td>Hari Jadwal</td>
				<td><input type="text" name="HARIJADWAL" value=<?php echo $HARIJADWAL;?>></td>></td>
			</tr>
			<tr> 
				<td>Sesi Jadwal</td>
				<td><input type="text" name="SESIJADWAL" value=<?php echo $SESIJADWAL;?>></td>></td>
			</tr>
			<tr> 
				<td>Waktu Mulai</td>
				<td><input type="text" name="WAKTU_MULAI" value=<?php echo $WAKTU_MULAI;?>></td>></td>
			</tr>
			<tr> 
				<td>Waktu Selesai</td>
				<td><input type="text" name="WAKTU SELESAI" value=<?php echo $WAKTU_SELESAI;?>></td>></td>
			</tr>
			<tr>
				<td><input type="hidden" name="IDJADWAL" value=<?php echo $_GET['IDJADWAL'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>