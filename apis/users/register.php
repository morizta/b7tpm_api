<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$user = json_decode(file_get_contents("php://input"));
// echo var_dump($data);
if(!$user->username){
    sendResponse(400, [] , 'User Name is Required !');  
}else if(!$user->password){
    sendResponse(400, [] , 'Password is Required !');        
}else if(!$user->passwordcf){
    sendResponse(400, [] , 'Password Confirmation is Required !');        
}else if(!$user->nik){
    sendResponse(400, [] , 'NIK is Required !');        
}else{
    if ($user->password != $user->passwordcf){
        sendResponse(400, [] , 'Password Confirmation Miss Match !');            
    }else{
        $conn=getConnection();
        if($conn==null){
            sendResponse(500,$conn,'Server Connection Error !');
        }else{
            $date = date("Y-m-d h:m");;
            $password=doEncrypt($user->password);
            $sql = "SELECT * FROM user WHERE username='";
            $sql.=$user->username."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {                
                sendResponse(400,$user,'Cannot create account, username already exists !');
            } else {
                $sql="INSERT INTO user(UserName, Password, FullName, Email, NIK, GroupId, IsActive, CreatedDate, CreatedBy)";
                $sql .= "VALUES ('".$user->username."','".$password."','', '".$user->email."', '".$user->nik."', 3, 1, '".$date."', 'system')";
              
                $result = $conn->query($sql);
                if ($result) {
                    sendResponse(200, $result , 'User Registration Successful.');
                } else {
                    sendResponse(404, [] ,'User not Registered');
                };
            }
            $conn->close();
        }
    }
}