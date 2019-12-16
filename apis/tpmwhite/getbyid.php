<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
// echo var_dump($data);
// if(!$user->username){
//     sendResponse(400, [] , 'User Name is Required !');  
// }else if(!$user->password){
//     sendResponse(400, [] , 'Password is Required !');        
// }else{

$data = json_decode(file_get_contents("php://input"));
// echo var_dump($data);
if(!$data->id){
    sendResponse(400, [] , 'Id is Required !');  
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        $sql = "SELECT * FROM tpm_whitetag where id ='".$data->id."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data=array();
            while($row = $result->fetch_assoc()) {

                $tglPemasangan = "";
                if(strtotime($row['TanggalPemasangan']) > 0){
                   $tglPemasangan = $row["TanggalPemasangan"];
                }

                $dueDate = "";
                if(strtotime($row['DueDate']) > 0){
                   $dueDate = $row["DueDate"];
                }

                $arr=array(
                    "id" =>  $row["Id"],
                    "nokontrol" => $row["NoKontrol"],
                    "bagianmesin" => $row["BagianMesin"],
                    "dipasangoleh" => $row["DipasangOleh"],
                    "tanggalpemasangan" => $tglPemasangan,
                    "deskripsi" => $row["Deskripsi"],
                    "duedate" => $dueDate,
                    "status" => $row["Status"],
                    "penanggulangan" => $row["Penanggulangan"],
                    "createddate" => $row["CreatedDate"],
                    "createdby" => $row["CreatedBy"],
                    "modifieddate" => $row["ModifiedDate"],
                    "modifiedby" => $row["ModifiedBy"],
                );
                array_push($data,$arr);
            }
            sendResponse(200,$data,'List TPM Red Tag');
        } else {
            sendResponse(404,[],'Not Found!');
        }
        $conn->close();
    }
}