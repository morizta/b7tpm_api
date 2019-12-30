<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$user = json_decode(file_get_contents("php://input"));



// $user = $_POST['username'];
// if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name']))
// {
//     $name=$_FILES['file']['name'];

//     $size=$_FILES['file']['size'];
//     $type=$_FILES['file']['type'];
//     $tmp_name=$_FILES['file']['tmp_name'];
//     $location= $_SERVER['DOCUMENT_ROOT']."/B7TPMAPI/apis/tpmred/upload/";
//     if(move_uploaded_file($tmp_name, $location.$name))
//     {
//         echo $name."Success".$user;
//     }
// }

// echo var_dump($data);
if(!$user->nokontrol){
    sendResponse(400, [] , 'Nomor Kontrol tidak boleh kosong !');       
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        $date = date("Y-m-d h:m");
        $sql="INSERT INTO tpm_redtag (NoKontrol, BagianMesin, DipasangOleh, TanggalPemasangan, Deskripsi, NoWorkRequest, PICFollowUp, DueDate, Status, Penanggulangan, CreatedDate, CreatedBy) ";
        $sql .= "VALUES ('".$user->nokontrol."','".$user->bagianmesin."', '".$user->dipasangoleh."', '".$user->tanggalpemasangan."', '".$user->deskripsi."', '".$user->noworkrequest."', '".$user->picfollowup."', '".$user->duedate."', '".$user->status."', '".$user->penanggulangan."', '".$date."', '".$user->createdby."')";
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