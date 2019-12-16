<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$user = json_decode(file_get_contents("php://input"));
// echo var_dump($data);
if(!$user->nokontrol){
    sendResponse(400, [] , 'Nomor Kontrol tidak boleh kosong !');       
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        $date = date("Y-m-d h:m");
        $sql="UPDATE INTO tpm_whitetag set NoKontrol = '".$user->nokontrol."', BagianMesin = '".$user->bagianmesin."', DipasangOleh = '".$user->dipasangoleh."', TanggalPemasangan = '".$user->tanggalpemasangan."', Deskripsi = '".$user->deskripsi."', DueDate = '".$user->duedate."', Status = '".$user->status."', Penanggulangan = '".$user->penanggulangan."' where Id = '".$user->id."'";
        // echo var_dump($sql);
        $result = $conn->query($sql);
        if ($result) {
            sendResponse(200, $result , 'Update Data Successful.');
        } else {
            sendResponse(404, [] ,'Insert Data Failed');
        };
        
        $conn->close();
    }
}