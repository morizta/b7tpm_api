<?php
include_once('../../common/include.php');
// $user = json_decode(file_get_contents("php://input"));
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");

$nokontrol = $_POST['nokontrol'];
$bagianmesin = $_POST['bagianmesin'];
$id = $_POST['id'];
$tanggalpemasangan = $_POST['tanggalpemasangan'];
$deskripsi = $_POST['deskripsi'];
$duedate = $_POST['duedate'];
$dipasangoleh = $_POST['dipasangoleh'];
$penanggulangan = $_POST['penanggulangan'];
$status = $_POST['status'];
$createdby = $_POST['createdby'];
$createddate = $_POST['createddate'];
$modifiedby = $_POST['modifiedby'];
$modifieddate = $_POST['modifieddate'];

if(!$nokontrol){
    sendResponse(400, [] , 'Nomor Kontrol tidak boleh kosong !');       
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        $date = date("Y-m-d h:m");
        $sql="INSERT INTO tpm_whitetag (NoKontrol, BagianMesin, DipasangOleh, TanggalPemasangan, Deskripsi, DueDate, Status, Penanggulangan, CreatedDate, CreatedBy) ";
        $sql .= "VALUES ('".$nokontrol."','".$bagianmesin."', '".$dipasangoleh."', '".$tanggalpemasangan."', '".$deskripsi."',  '".$duedate."', '".$status."', '".$penanggulangan."', '".$date."', '".$createdby."')";
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
                $location= $_SERVER['DOCUMENT_ROOT']."/B7TPMAPI/apis/tpmwhite/upload/";
                if(move_uploaded_file($tmp_name, $location.$name))
                {
                    $sql="UPDATE tpm_whitetag set FileName = '".$name."' where Id = '".$last_id."'";
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