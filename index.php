<?php
// Create database connection using config file
include_once("koneksi.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM jadwal_pelajaran");
?>
 
<html>
<head>    
    <title>Jadwal Pelajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="contaianer">
        <a href="add.php" class="btn btn-primary">Add New User</a>
            <br/>
                <br/>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID_jadwal</th> 
                        <th>ID_Guru</th> 
                        <th>Kode_Mapel</th> 
                        <th>No_Induk</th> 
                        <th>ID_Ruang</th> 
                        <th>Hari_Jadwal</th> 
                        <th>Sesi_Jadwal</th> 
                        <th>Waktu_Mulai</th> 
                        <th>Waktu_Selesai</th> 
                        <th>Update</th> 
                    </tr>
                </thead>
                <?php  
                while($user_data = mysqli_fetch_array($result)) {         
                    echo "<tr>";
                    echo "<td>".$user_data['ID_JADWAL']."</td>";
                    echo "<td>".$user_data['ID_GURU']."</td>";
                    echo "<td>".$user_data['KODE_MAPEL']."</td>";
                    echo "<td>".$user_data['NO_INDUK']."</td>";
                    echo "<td>".$user_data['ID_RUANG']."</td>"; 
                    echo "<td>".$user_data['HARIJADWAL']."</td>";
                    echo "<td>".$user_data['SESIJADWAL']."</td>";  
                    echo "<td>".$user_data['WAKTU_MULAI']."</td>";
                    echo "<td>".$user_data['WAKTU_SELESAI']."</td>";
                    echo "<td><a href='edit.php?id=$user_data[ID_JADWAL]' class='btn btn-success'>Edit</a> | <a href='delete.php?id=$user_data[ID_JADWAL]'class='btn btn-danger'>Delete</a></td></tr>";        
                }
                ?>
            </table>
        </div>  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>