<?php
if(!class_exists("BTCRepository")){
    require("Repository/BTCRepository.php");
}
class BTCController{
    
    public function current(){
        $data =BTCRepository::getLast();
        $jumlah = BTCRepository::getCount();
        $pesan="";
        $pesan ="*Data BTC Terakhir :* \n";
        $pesan .="*Jumlah Data :* ".$jumlah." \n";
        $pesan.= "*Tanggal* : ".$data->tanggal."\n";
        $pesan.= "*Sinyal* : ".$data->sinyal."\n";
        $pesan.= "*Level* : ".$data->level."\n";
        $pesan.= "*Harga (BTC/IDR)* : Rp.".number_format($data->hargaidr)."\n";
        $pesan.= "*Harga (BTC/USDT)* : $ ".number_format($data->hargausdt)."\n";
        $pesan.= "*Volume (IDR)* : ".number_format($data->volidr,8)."\n";
        $pesan.= "*Volume (USDT)* : ".number_format($data->volusdt)."\n";
        MessageHandler::sendMessage($pesan);
    }

    public function getByDate(){
        $limit = 10;
        $startDate = Session::getParameter(1);
        $endDate = Session::getParameter(2);

        // check startdate is valid
        if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$startDate)){
           return MessageHandler::sendMessage("*Terjadi kesalahan* harap masukkan satu atau dua parameter tanggal dengan format 'YYYY-mm-dd'");
        }else{
            if($endDate != null){
                if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$endDate)){
                    return MessageHandler::sendMessage("*Terjadi kesalahan* harap masukkan parameter kedua dengan format 'YYYY-mm-dd'");
                }
            }
            $page = 1;
            if(Session::$hasSession){
                $valid = false;
                $request = Session::getRequest().trim();
                if($request == "@exit"){
                    call_controller([GeneralController::class, 'index']);
                    Session::deleteSessionId();
                    return;
                }
                if(preg_match("/@page(\d+)/", $request, $matches)){
                    $page = $matches[1];
                    if(is_numeric($page)){
                        $page = intval($page);
                        $valid = true;
                    }
                }
                if(!$valid){
                    Session::deleteSessionId();
                    MessageHandler::sendMessage("*Tidak ditemukan halaman $request*");
                    return;
                }
            }

            $data = BTCRepository::getByDate($startDate, $endDate, $page);
            $maxPage = $data["maxPage"];
            $data = $data["data"];

            // make page button 
            $lastPage = $page + 2;
            if($lastPage > $maxPage){
                $lastPage = $maxPage;
            }

            $firstPage =  $page - 2;
            if($firstPage < 1){
                $firstPage = 1;
            }

            
            $keyboard = [
                "keyboard"=>[],
                "one_time_keyboard"=>true,
                "resize_keyboard"=>true,
    
            ];
            for($i = $page - 2; $i <= $lastPage; $i++){
                if($i > 0 && $i <= $maxPage){
                    if($i != $page){
                        $keyboard["keyboard"][] = ["@page".$i];
                    }
                }
            }
            $keyboard["keyboard"][] = ["@exit"];
            if(count($data) == 0){
                Session::deleteSessionId();
                MessageHandler::sendMessage("*Tidak ditemukan data*");
                return;
            }else{
                if($endDate != null){
                    $pesan = "*Data BTC dari $startDate sampai $endDate :* \n";
                }else{
                    $pesan = "*Data BTC dari $startDate :* \n";
                }
                $pesan .= "*Jumlah Data :* ".count($data)." \n";
                $pesan .= "*Halaman :* ".$page." / ".$maxPage."\n\n";
                foreach($data as $row){
                    $pesan .= "*Tanggal* : ".$row->tanggal."\n";
                    $pesan .= "*Sinyal* : ".$row->sinyal."\n";
                    $pesan .= "*Level* : ".$row->level."\n";
                    $pesan .= "*Harga (BTC/IDR)* : Rp.".number_format($row->hargaidr)."\n";
                    $pesan .= "*Harga (BTC/USDT)* : $ ".number_format($row->hargausdt)."\n";
                    $pesan .= "*Volume (IDR)* : ".number_format($row->volidr,8)."\n";
                    $pesan .= "*Volume (USDT)* : ".number_format($row->volusdt)."\n\n";
                }
                Session::setSessionId();
                MessageHandler::sendButton($keyboard,$pesan);
            }

        }
    }


    public function last(){
        $limit = Session::getParameter(1,1);
        $max = 20;
        $pesan="";
        if(!is_numeric($limit)){
            $limit = 1;
        }
        if($limit > $max){
            $pesan = "*Maaf terjadi kesalahan, jumlah data yang dapat ditampilkan hanya 20 data terakhir*";
            return  MessageHandler::sendMessage($pesan);
        }else{
            $page = 1;
            if(Session::$hasSession){
                $valid = false;
                $request = Session::getRequest().trim();
                if($request == "@exit"){
                    call_controller([GeneralController::class, 'index']);
                    Session::deleteSessionId();
                    return;
                }
                if(preg_match("/@page(\d+)/", $request, $matches)){
                    $page = $matches[1];
                    if(is_numeric($page)){
                        $page = intval($page);
                        $valid = true;
                    }
                }
                if(!$valid){
                    Session::deleteSessionId();
                    MessageHandler::sendMessage("*Tidak ditemukan halaman $request*");
                    return;
                }
            }

            $maxPage = ceil(BTCRepository::getCount()/$limit);
            if($page > $maxPage){
                $page = $maxPage;
            }

            // make page button 
            $lastPage = $page + 2;
            if($lastPage > $maxPage){
                $lastPage = $maxPage;
            }

            $firstPage =  $page - 2;
            if($firstPage < 1){
                $firstPage = 1;
            }

            
            $keyboard = [
                "keyboard"=>[],
                "one_time_keyboard"=>true,
                "resize_keyboard"=>true,
    
            ];
            for($i = $page - 2; $i <= $lastPage; $i++){
                if($i > 0 && $i <= $maxPage){
                    if($i != $page){
                        $keyboard["keyboard"][] = ["@page".$i];
                    }
                }
            }
            $keyboard["keyboard"][] = ["@exit"];
            $data =BTCRepository::getAllLimit($limit,$page);
            $pesan ="*Data BTC $limit Terakhir :* \n";
            $pesan .= "*Jumlah Data :* ".count($data)." \n";
            $pesan .= "*Halaman :* ".$page." / ".$maxPage."\n\n";
            foreach($data as $row){
                // id
                $pesan .="*".$row->id."* \n";
                $pesan .="*Tanggal* : ".$row->tanggal."\n";
                $pesan .="*Sinyal* : ".$row->sinyal."\n";
                $pesan .="*Level* : ".$row->level."\n";
                $pesan .="*Harga (BTC/IDR)* : Rp.".number_format($row->hargaidr)."\n";
                $pesan .="*Harga (BTC/USDT)* : $ ".number_format($row->hargausdt)."\n";
                $pesan .="*Volume (IDR)* : ".number_format($row->volidr,8)."\n";
                $pesan .="*Volume (USDT)* : ".number_format($row->volusdt)."\n\n";
            }

            Session::setSessionId();
            return  MessageHandler::sendButton($keyboard,$pesan);
        }
        

        
    }
}