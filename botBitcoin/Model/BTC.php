<?php

class BTC {
    public $id;
    public $sinyal;
    public $tanggal;
    public $level;
    public $hargaidr;
    public $hargausdt;
    public $volidr;
    public $volusdt;    
    public $lastbuy;
    public $lastsell;
    public $jenis;
    
    public function __construct($id, $sinyal, $tanggal, $level, $hargaidr, $hargausdt, $volidr, $volusdt, $lastbuy, $lastsell, $jenis) {
        $this->id = $id;
        $this->sinyal = $sinyal;
        $this->tanggal = $tanggal;
        $this->level = $level;
        $this->hargaidr = $hargaidr;
        $this->hargausdt = $hargausdt;
        $this->volidr = $volidr;
        $this->volusdt = $volusdt;
        $this->lastbuy = $lastbuy;
        $this->lastsell = $lastsell;
        $this->jenis = $jenis;
    }
}