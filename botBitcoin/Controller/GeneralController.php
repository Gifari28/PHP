<?php 

class GeneralController{
    public function index(){
        // help message
        $pesan = "*Selamat Datang di BTC-BOT*\n\n";
        $pesan .= "*Daftar Perintah*\n";
        $pesan .= "/current - Menampilkan data saat ini\n";
        $pesan .="/getbydate - Menampilkan data dengan filter dari satu atau dua parameter berupa tanggal\n";
        $pesan .= "/last - Menampilkan data terakhir dengan parameter setelahnya contohnya '/last 10'\n";
        $pesan .= "/help - Menampilkan pesan ini\n";

        MessageHandler::sendMessage($pesan);
    }

    public function not_found(){
        $keyboard = [
            "keyboard"=>[
                ["/help"],
            ],
            "one_time_keyboard"=>true,
            "resize_keyboard"=>true,

        ];
        MessageHandler::sendButton($keyboard,"*Maaf terjadi kesalahan, perintah tidak ditemukan*");
    }

}