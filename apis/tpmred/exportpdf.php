<?php
include_once('../../common/include.php');
include_once('../../common/helper.php');
// include_once('../../');
$html_template =  file_get_contents("../../template/redtag.html");
$data = json_decode(file_get_contents("php://input"));

$conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        $sql = "SELECT * FROM tpm_redtag where id = ".$data->id."";
        // echo $sql; die();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // $data=array();
            $file_names = "";
            
            while($row = $result->fetch_assoc()) {

                $tglPemasangan = "";
                if(strtotime($row['TanggalPemasangan']) > 0){
                   $tglPemasangan = $row["TanggalPemasangan"];
                }

                $dueDate = "";
                if(strtotime($row['DueDate']) > 0){
                   $dueDate = $row["DueDate"];
                }
                
                $html_template = str_replace("{nokontrol}", $row["NoKontrol"], $html_template);
                $html_template = str_replace("{bagianmesin}", $row["BagianMesin"], $html_template);
                $html_template = str_replace("{tanggalpemasangan}", $tglPemasangan, $html_template);
                $html_template = str_replace("{dipasangoleh}", $row["DipasangOleh"], $html_template);
                $html_template = str_replace("{deskripsi}", $row["Deskripsi"], $html_template);
                $html_template = str_replace("{noworkrequest}", $row["NoWorkRequest"], $html_template);
                $html_template = str_replace("{picfollowup}", $row["PICFollowUp"], $html_template);
                $html_template = str_replace("{duedate}", $row["DueDate"], $html_template);
                $html_template = str_replace("{penanggulangan}", $row["Penanggulangan"], $html_template);
                $html_template = str_replace("{penanggulangan}", $row["Penanggulangan"], $html_template);
                $html_template = str_replace("{imageurl}", $row["FileName"] ? base_url()."tpmred/upload/".$row["FileName"] : null, $html_template);
                
                // var_dump( $html_template ); die();
                $file_names = exportPDF($html_template, 'tpmred', null);
            }

            if ($file_names != "") {
                $query = "UPDATE tpm_redtag set Status = 'Open' where id =".$data->id."";
                $res = $conn->query($sql);
                if ($res) {
                    sendResponse(200, $file_names ,'Sukses Export Data');
                } else {
                    sendResponse(404, [] ,'Export Data Gagal');
                };
            }else{
                sendResponse(404, [] ,'Export Data Gagal');                
            }

            // echo var_dump($data);
        } else {
            sendResponse(404,[],'Not Found!');
            // echo "not found";
        }
        $conn->close();
    }