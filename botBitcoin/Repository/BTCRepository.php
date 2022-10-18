<?php 

if(!class_exists("BTC")){
    require("Model/BTC.php");
}


class BTCRepository{
    public static function getCount(){
        $sql = "SELECT COUNT(*) as jumlah FROM btc";
        $result = Koneksi::getConnection()->query($sql);
        $row = $result->fetch_assoc();
        return $row['jumlah'];
    }

    //  fetch data limit
    public static function getAllLimit($limit,$page =1){
        $offset = ($page-1)*$limit;
        $sql = "SELECT * FROM btc ORDER BY id DESC LIMIT $limit OFFSET $offset";
        $result = Koneksi::getConnection()->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()){
            $data[] = new BTC($row['id'], $row['sinyal'], $row['tanggal'], $row['level'], $row['hargaidr'], $row['hargausdt'], $row['volidr'], $row['volusdt'], $row['lastbuy'], $row['lastsell'], $row['jenis']);
        }
        return $data;
    }



    public static function getByDate($startDate,$endDate = null, $page =1){
        $limit = 10;
        $offset = ($page-1)*$limit;
        if($endDate == null){
            $sql = "SELECT * FROM btc WHERE tanggal > '$startDate' ORDER BY id DESC ";
        }else{
            $sql = "SELECT * FROM btc WHERE tanggal BETWEEN '$startDate' AND '$endDate 23:59' ORDER BY id DESC ";
        }
        $result = Koneksi::getConnection()->query($sql." LIMIT $limit OFFSET $offset");
        $data = [];
        $totalAll = Koneksi::getConnection()->query($sql)->num_rows;
        $maxPage = ceil($totalAll/$limit);
        while($row = $result->fetch_assoc()){
            $data[] = new BTC($row['id'], $row['sinyal'], $row['tanggal'], $row['level'], $row['hargaidr'], $row['hargausdt'], $row['volidr'], $row['volusdt'], $row['lastbuy'], $row['lastsell'], $row['jenis']);
        }
        return [
            "data"=>$data,
            "maxPage"=>$maxPage,
            "totalAll"=>$totalAll
        ];
    }

    // get last data
    public static function getLast():BTC{
        $sql = "SELECT * FROM btc ORDER BY id DESC LIMIT 1";
        $result = Koneksi::getConnection()->query($sql);
        $row = $result->fetch_assoc();
        return new BTC($row['id'], $row['sinyal'], $row['tanggal'], $row['level'], $row['hargaidr'], $row['hargausdt'], $row['volidr'], $row['volusdt'], $row['lastbuy'], $row['lastsell'], $row['jenis']);
    }
}