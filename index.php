<form  method="post">
    <input type="number" name="hari" placeholder="Masukkan Angka Hari">
    <input type="submit" name="submit" value="Enter">
</form>
<?php
if(isset($_POST["hari"])){
    $hari = $_POST['hari'];
    echo "<h1>";
    if($hari == 1){
        echo "Senin";
    }else if($hari == 2){
        echo "Selasa";
    }else if($hari == 3){
        echo "Rabu";
    }else if($hari == 4){
        echo "Kamis";
    }else if($hari == 5){
        echo "Jumat";
    }else if($hari == 6){
        echo "Sabtu";
    }else if($hari == 7){
        echo "Minggu";
    }else{
        echo "Hari tidak diketahui";
    }
    echo "</h1>";
}
?>

 
