<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$user = json_decode(file_get_contents("php://input"));
// echo var_dump($data);
if(!$user->username){
    sendResponse(400, [] , 'User Name is Required !');  
}else if(!$user->password){
    sendResponse(400, [] , 'Password is Required !');        
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        $password=doEncrypt($user->password);
        $sql = "SELECT id, username, email FROM user WHERE username='";
        $sql.=$user->username."' AND password = '".$password."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $users=array();
            while($row = $result->fetch_assoc()) {
                $user=array(
                    "id" =>  $row["id"],
                    "userename" => $row["username"],
                    "email" => $row["email"],
                );
                array_push($users,$user);
            }
            sendResponse(200,$users,'User Details');
        } else {
            sendResponse(404,[],'User not available');
        }
        $conn->close();
    }
}