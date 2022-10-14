<?php
	// include database connection file
	include_once("koneksi.php");
?>
<html>
<head>
	<title>Add Users</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
 
<body>
	<div class="container my-3 mx-auto">
		<div class="mx-auto w-100">
			<a href="index.php" class="btn btn-primary">Go to Home</a>
	<br/><br/>
 
	<form action="add.php" method="post" name="form1">
		<table>
			<tr>
				<td>ID Jadwal</td>
				<td><input class="form-control form-control-sm" type="text" name="ID_JADWAL"></td>
			</tr>
			<tr> 
				<td>Nama Guru</td>
				<td><select class="form-select form-select-sm" name="ID_GURU">
					<?php
					$result = mysqli_query($mysqli, "SELECT * FROM guru_pengajar");
					while($guru=mysqli_fetch_array($result))
					{
						echo "<option value='".$guru["ID_GURU"]."'>".$guru['NAMA_GURU']."</option>";
					
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
						echo "<option value='".$mapel["KODE_MAPEL"]."'>".$mapel['NAMA_MAPEL']."</option>";
					
					}
					?>
				</select></td>
			</tr>
			<tr> 
				<td>Nama Siswa atau Siswi</td>
				<td><select class="form-select form-select-sm" name="NO_INDUK">
					<?php
					$result = mysqli_query($mysqli, "SELECT * FROM murid");
					while($mrd=mysqli_fetch_array($result))
					{
						echo "<option value='".$mrd["NO_INDUK"]."'>".$mrd['NAMA_MURID']."</option>";
					
					}
					?>
				</select></td>
			<tr> 
				<td>Nama Ruang</td>
				<td><select class="form-select form-select-sm" name="ID_RUANG">
					<?php
					$result = mysqli_query($mysqli, "SELECT * FROM ruang_kelas");
					while($ruang=mysqli_fetch_array($result))
					{
						echo "<option value='".$ruang["ID_RUANG"]."'>".$ruang['NAMA_RUANG']."</option>";
					
					}
					?>
				</select></td>
			</tr>
			<tr> 
				<td>Jadwal Hari</td>
				<td><select class="form-select form-select-sm" name="HARIJADWAL">
					<option value="Senin">Senin</option>
					<option value="Selasa">Selasa</option>
					<option value="Rabu">Rabu</option>
					<option value="Kamis">Kamis</option>
					<option value="Jumat">Jumat</option>
				</select></td>
			</tr>
			<tr> 
				<td>Sesi Jadwal</td>
				<td><select class="form-select form-select-sm" name="SESIJADWAL">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select></td>
			</tr>
			<tr> 
				<td>Waktu Mulai</td>
				<td><select class="form-select form-select-sm" name="WAKTU_MULAI">
					<option value="07:00:00">07:00:00</option>
					<option value="09:30:00">09:30:00</option>
					<option value="12:00:00">12:00:00</option>
					<option value="14:30:00">14:30:00</option>
					<option value="15:30:00">15:30:00</option>
				</select></td>
			</tr>
			<tr> 
				<td>Waktu Selesai</td>
				<td><select class="form-select form-select-sm" name="WAKTU_SELESAI">
					<option value="09:00:00">09:00:00</option>
					<option value="11:30:00">11:30:00</option>
					<option value="14:00:00">14:00:00</option>
					<option value="15:30:00">15:30:00</option>
					<option value="16:30:00">16:30:00</option>
				</select></td>
			</tr>
			<tr> 
				<td></td>
				<td><input class="btn btn-secondary" type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>
		</div>
	</div>
	<?php
 
	// Check If form submitted, insert form data into users table.
	if(isset($_POST['Submit'])) {
		$ID_JADWAL= $_POST['ID_JADWAL'];
		$ID_GURU=$_POST['ID_GURU'];
		$KODE_MAPEL=$_POST['KODE_MAPEL'];
		$NO_INDUK=$_POST['NO_INDUK'];
		$ID_RUANG=$_POST['ID_RUANG'];
		$HARIJADWAL=$_POST['HARIJADWAL'];
		$SESIJADWAL=$_POST['SESIJADWAL'];
		$WAKTU_MULAI=$_POST['WAKTU_MULAI'];		
		$WAKTU_SELESAI=$_POST['WAKTU_SELESAI'];	
		// Insert user data into table
		$result = mysqli_query($mysqli, "INSERT INTO jadwal_pelajaran(ID_JADWAL,ID_GURU,KODE_MAPEL,NO_INDUK,ID_RUANG,HARIJADWAL,SESIJADWAL,WAKTU_MULAI,WAKTU_SELESAI) VALUES('$ID_JADWAL','$ID_GURU','$KODE_MAPEL','$NO_INDUK','$ID_RUANG','$HARIJADWAL','$SESIJADWAL','$WAKTU_MULAI','$WAKTU_SELESAI')");
		
		// Show message when user added
		echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>User added successfully<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		echo "<a class='btn btn-secondary' href='index.php'>View Users</a>";
	}
	?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>