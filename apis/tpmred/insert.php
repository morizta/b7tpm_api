<?php
include_once('../../common/include.php');
// $user = json_decode(file_get_contents("php://input"));
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");


// $conn=getConnection();

// if($_FILES['file'])
// {
//     if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name']))
//     {
//         $name=$_FILES['file']['name'];
//         $size=$_FILES['file']['size'];
//         $type=$_FILES['file']['type'];
//         $tmp_name=$_FILES['file']['tmp_name'];
//         $location= $_SERVER['DOCUMENT_ROOT']."/B7TPMAPI/apis/tpmred/upload/";
//         if(move_uploaded_file($tmp_name, $location.$name))
//         {
//             $sql="UPDATE tpm_redtag set FileName = '".$name."' where Id = 10";
//             // var_dump($sql); die();
//             $result = $conn->query($sql);
//             if ($result) {
//                 sendResponse(200, $location , '2Insert Data Successful.');
//             } else {
//                 sendResponse(404, $name ,'3Insert Data Failed');
//             };
//         }else{                    
//             sendResponse(200, $location , '1Insert Data Successful.');
//         }
//     }else{
//         sendResponse(200, 'not found2' , 'Insert Data Successful.');
//     }
// }else{
//     sendResponse(200, 'not found1' , 'Insert Data Successful.');

// }
// $conn->close();

$nokontrol = $_POST['nokontrol'];
$bagianmesin = $_POST['bagianmesin'];
$id = $_POST['id'];
$tanggalpemasangan = $_POST['tanggalpemasangan'];
$deskripsi = $_POST['deskripsi'];
$noworkrequest = $_POST['noworkrequest'];
$picfollowup = $_POST['picfollowup'];
$duedate = $_POST['duedate'];
$dipasangoleh = $_POST['dipasangoleh'];
$penanggulangan = $_POST['penanggulangan'];
$status = $_POST['status'];
$createdby = $_POST['createdby'];
$createddate = $_POST['createddate'];
$modifiedby = $_POST['modifiedby'];
$modifieddate = $_POST['modifieddate'];


// // // echo var_dump($data);
if(!$nokontrol){
    sendResponse(400, [] , 'Nomor Kontrol tidak boleh kosong !');       
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        $date = date("Y-m-d h:m");
        $sql="INSERT INTO tpm_redtag (NoKontrol, BagianMesin, DipasangOleh, TanggalPemasangan, Deskripsi, NoWorkRequest, PICFollowUp, DueDate, Status, Penanggulangan, CreatedDate, CreatedBy) ";
        $sql .= "VALUES ('".$nokontrol."','".$bagianmesin."', '".$dipasangoleh."', '".$tanggalpemasangan."', '".$deskripsi."', '".$noworkrequest."', '".$picfollowup."', '".$duedate."', '".$status."', '".$penanggulangan."', '".$date."', '".$createdby."')";
        // echo var_dump($sql); die;
        $result = $conn->query($sql);
        if ($result) {  
            $last_id = $conn->insert_id;          
            if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name']))
            {
                $name=$_FILES['file']['name'];
                $size=$_FILES['file']['size'];
                $type=$_FILES['file']['type'];
                $tmp_name=$_FILES['file']['tmp_name'];
                $location= $_SERVER['DOCUMENT_ROOT']."/B7TPMAPI/apis/tpmred/upload/";
                if(move_uploaded_file($tmp_name, $location.$name))
                {
                    $sql="UPDATE tpm_redtag set FileName = '".$name."' where Id = '".$last_id."'";
                    $result = $conn->query($sql);
                    if ($result) {
                        sendResponse(200, $result , 'Insert Data Successful.');
                    } else {
                        sendResponse(404, [] ,'Insert Data Failed');
                    };
                }else{                    
                    sendResponse(200, $result , 'Insert Data Successful.');
                }
            }else{
                sendResponse(200, $result , 'Insert Data Successful.');
            }
        } else {
            sendResponse(404, [] ,'Insert Data Failed');
        };
        
        $conn->close();
    }
}