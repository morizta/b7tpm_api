<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');

$data = json_decode(file_get_contents("php://input"));

if(!$data->code){
    sendResponse(400, [] , 'Code is Required !');  
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        $sql = "SELECT * FROM info_mesin where Barcode ='".$data->code."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data=array();
            while($row = $result->fetch_assoc()) {

                $tglMulaiOperasi = "";
                if(strtotime($row['TglMulaiOperasi']) > 0){
                   $tglMulaiOperasi = $row["TglMulaiOperasi"];
                }

                $arr=array(
                    "id" =>  $row["Id"],
                    "noasset" => $row["NoAsset"],
                    "nomesin" => $row["NoMesin"],
                    "code" => $row["Barcode"],
                    "tglmulaioperasi" => $tglMulaiOperasi,
                    "ruang" => $row["Ruang"],
                    "ceateddate" => $row["CreatedDate"],
                    "createdby" => $row["CreatedBy"],
                );
                array_push($data,$arr);
            }
            sendResponse(200,$data,'List Informasi Mesin');
        } else {
            sendResponse(404,[],'Code Not Found!');
        }
        $conn->close();
    }
}