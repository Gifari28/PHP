<?php
// include database connection file
include_once("koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{	
		$ID_JADWAL= $_POST['ID_JADWAL'];
		$ID_GURU=$_POST['ID_GURU'];
		$KODE_MAPEL=$_POST['KODE_MAPEL'];
		$NO_INDUK=$_POST['NO_INDUK'];
		$ID_RUANG=$_POST['ID_RUANG'];
		$HARIJADWAL=$_POST['HARIJADWAL'];
		$SESIJADWAL=$_POST['SESIJADWAL'];
		$WAKTU_MULAI=$_POST['WAKTU_MULAI'];		
		$WAKTU_SELESAI=$_POST['WAKTU_SELESAI'];
		
	// update user data
	$result = mysqli_query($mysqli, "UPDATE jadwal_pelajaran SET ID_GURU='$ID_GURU',KODE_MAPEL='$KODE_MAPEL',NO_INDUK='$NO_INDUK',ID_RUANG='$ID_RUANG',HARIJADWAL='$HARIJADWAL',SESIJADWAL='$SESIJADWAL',WAKTU_MULAI='$WAKTU_MULAI',WAKTU_SELESAI='$WAKTU_SELESAI' WHERE ID_JADWAL='$ID_JADWAL'");
	
	// Redirect to homepage to display updated user in list
	header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM jadwal_pelajaran WHERE ID_JADWAL='$id'");
 
while($user_data = mysqli_fetch_array($result))
{
	$ID_JADWAL= $user_data['ID_JADWAL'];
	$ID_GURU = $user_data['ID_GURU'];
	$KODE_MAPEL = $user_data['KODE_MAPEL'];
	$NO_INDUK=$user_data['NO_INDUK'];
	$ID_RUANG = $user_data['ID_RUANG'];
	$HARIJADWAL=$user_data['HARIJADWAL'];
	$SESIJADWAL=$user_data['SESIJADWAL'];
	$WAKTU_MULAI=$user_data['WAKTU_MULAI'];		
	$WAKTU_SELESAI=$user_data['WAKTU_SELESAI'];
}
?>
<html>
<head>	
	<title>Edit User Data</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
 
<body>
<div class="container my-3 mx-auto">
		<div class="mx-auto w-100">
		<a class="btn btn-primary" href="index.php">Home</a>
	<br/><br/>
	
	<form name="update_user" method="post" action="edit.php">
		<table border="0">
				<td>Nama Guru</td>
				<td><select class="form-select form-select-sm" name="ID_GURU">
					<?php
					$result = mysqli_query($mysqli, "SELECT * FROM guru_pengajar");
					while($guru=mysqli_fetch_array($result))
					{
						if($guru["ID_GURU"] == $ID_GURU){
							echo "<option selected value='".$guru["ID_GURU"]."'>".$guru['NAMA_GURU']."</option>";
							}else{
							echo "<option value='".$guru["ID_GURU"]."'>".$guru['NAMA_GURU']."</option>";
							}
					
					}
					?>
				</select></td>
			</tr>
			<tr> 
				<td>MAPEL</td>
				<td><select class="form-select form-select-sm" name="KODE_MAPEL">
					<?php
					$result = mysqli_query($mysqli, "SELECT * FROM mata_pelajaran");
					while($mapel=mysqli_fetch_array($result))
					{
						if($mapel["KODE_MAPEL"] == $KODE_MAPEL){
							echo "<option selected value='".$mapel["KODE_MAPEL"]."'>".$mapel['NAMA_MAPEL']."</option>";
							}else{
							echo "<option value='".$mapel["KODE_MAPEL"]."'>".$mapel['NAMA_MAPEL']."</option>";
							}
					}
					?>
				</select></td>
			</tr>
			<tr> 
				<td>Nama Siswa atau Siswi</td>
				<td><select class="form-select form-select-sm" name="NO_INDUK">
					<?php
					$result = mysqli_query($mysqli, "SELECT * FROM murid");
					while($noinduk=mysqli_fetch_array($result))
					{
						if($noinduk["NO_INDUK"] == $NO_INDUK){
							echo "<option selected value='".$noinduk["NO_INDUK"]."'>".$noinduk['NAMA_MURID']."</option>";
							}else{
							echo "<option value='".$noinduk["NO_INDUK"]."'>".$noinduk['NAMA_MURID']."</option>";
							}
					}
					?>
				</select></td>
			</tr>
			<tr> 
				<td>Nama Ruang</td>
				<td><select class="form-select form-select-sm" name="ID_RUANG">
					<?php
					$result = mysqli_query($mysqli, "SELECT * FROM ruang_kelas");
					while($ruang=mysqli_fetch_array($result))
					{
						if($ruang["ID_RUANG"] == $ID_RUANG){
							echo "<option selected value='".$ruang["ID_RUANG"]."'>".$ruang['NAMA_RUANG']."</option>";
							}else{
							echo "<option value='".$ruang["ID_RUANG"]."'>".$ruang['NAMA_RUANG']."</option>";
							}
					}
					?>
				</select></td>
			</tr>
			<tr> 
				<td>Jadwal Hari</td>
				<td><select class="form-select form-select-sm" name="HARIJADWAL">
					<option <?= $HARIJADWAL== 'Senin' ? "selected" : ""?>  value="Senin">Senin</option>
					<option <?= $HARIJADWAL== 'Selasa' ? "selected" : ""?> value="Selasa">Selasa</option>
					<option <?= $HARIJADWAL== 'Rabu' ? "selected" : ""?>   value="Rabu">Rabu</option>
					<option <?= $HARIJADWAL== 'Kamis' ? "selected" : ""?>  value="Kamis">Kamis</option>
					<option <?= $HARIJADWAL== 'Jumat' ? "selected" : ""?>  value="Jumat">Jumat</option>
				</select></td>
			</tr>
			<tr> 
				<td>Sesi Jadwal</td>
				<td><select class="form-select form-select-sm" name="SESIJADWAL">
					<option <?= $SESIJADWAL== '1' ? "selected" : ""?> value="1">1</option>
					<option <?= $SESIJADWAL== '2' ? "selected" : ""?> value="2">2</option>
					<option <?= $SESIJADWAL== '3' ? "selected" : ""?> value="3">3</option>
					<option <?= $SESIJADWAL== '4' ? "selected" : ""?> value="4">4</option>
					<option <?= $SESIJADWAL== '5' ? "selected" : ""?> value="5">5</option>
				</select></td>
			</tr>
			<tr> 
				<td>Waktu Mulai</td>
				<td><select class="form-select form-select-sm" name="WAKTU_MULAI">
					<option <?= $WAKTU_MULAI== '07:00:00' ? "selected" : ""?> value="07:00:00">07:00:00</option>
					<option <?= $WAKTU_MULAI== '09:30:00' ? "selected" : ""?> value="09:30:00">09:30:00</option>
					<option <?= $WAKTU_MULAI== '12:00:00' ? "selected" : ""?> value="12:00:00">12:00:00</option>
					<option <?= $WAKTU_MULAI== '14:30:00' ? "selected" : ""?> value="14:30:00">14:30:00</option>
					<option <?= $WAKTU_MULAI== '15:30:00' ? "selected" : ""?> value="15:30:00">15:30:00</option>
				</select></td>
			</tr>
			<tr> 
				<td>Waktu Selesai</td>
				<td><select class="form-select form-select-sm" name="WAKTU_SELESAI">
					<option <?= $WAKTU_SELESAI== '09:00:00' ? "selected" : ""?> value="09:00:00">09:00:00</option>
					<option <?= $WAKTU_SELESAI== '11:30:00' ? "selected" : ""?> value="11:30:00">11:30:00</option>
					<option <?= $WAKTU_SELESAI== '14:00:00' ? "selected" : ""?> value="14:00:00">14:00:00</option>
					<option <?= $WAKTU_SELESAI== '15:30:00' ? "selected" : ""?> value="15:30:00">15:30:00</option>
					<option <?= $WAKTU_SELESAI== '16:30:00' ? "selected" : ""?> value="16:30:00">16:30:00</option>
				</select></td>
			</tr>
			<tr>
				<td><input type="hidden" name="ID_JADWAL" value=<?php echo $_GET['id'];?>></td>
				<td><input class="btn btn-secondary" type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
		</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>