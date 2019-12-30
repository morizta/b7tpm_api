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
        $sql = "select u.id, u.username, u.fullname, u.email, u.nik, g.Id 'groupid', g.groupname from user u ";
        $sql.= "join groups g on u.GroupId = g.Id where u.UserName ='".$user->username."'";
        $sql.= "and password = '".$password."'";

        // var_dump($sql); die;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $users=array();
            while($row = $result->fetch_assoc()) {
                $user=array(
                    "id" =>  $row["id"],
                    "userename" => $row["username"],
                    "email" => $row["email"],
                    "fullname" => $row["fullname"],
                    "nik" => $row["nik"],
                    "groupid" => $row["groupid"],
                    "groupname" => $row["groupname"],
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