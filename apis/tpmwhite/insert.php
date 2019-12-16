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
        $sql="INSERT INTO tpm_whitetag (NoKontrol, BagianMesin, DipasangOleh, TanggalPemasangan, Deskripsi, DueDate, Status, Penanggulangan, CreatedDate, CreatedBy) ";
        $sql .= "VALUES ('".$user->nokontrol."','".$user->bagianmesin."', '".$user->dipasangoleh."', '".$user->tanggalpemasangan."', '".$user->deskripsi."', '".$user->duedate."', '".$user->status."', '".$user->penanggulangan."', '".$date."', '".$user->createdby."')";
        // echo var_dump($sql);
        $result = $conn->query($sql);
        if ($result) {
            sendResponse(200, $result , 'Insert Data Successful.');
        } else {
            sendResponse(404, [] ,'Insert Data Failed');
        };
        
        $conn->close();
    }
}