<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$user = json_decode(file_get_contents("php://input"));

$query = "SELECT * FROM user";
$where = "";
if($user->where){
    if($user->where_logic){
        foreach ($user->where as $key => $value) {
            if ($key == "password") $value = doEncrypt($value);
            $value= is_numeric($value) ? $value : "'".$value."'";
            $where.= $key." = ".$value.", ";
        }
        $where = substr($where, 0, -2);
    }else{
        
    }
    $where = substr($where, 0, -2);
}

// echo $where;

$conn=getConnection();
if($conn==null){
    sendResponse(500,$conn,'Server Connection Error !');
}else{
    $sql = $query;
    if ($where!=""){
        $sql.=" WHERE ".$where;
    }

    echo $sql;
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     $users=array();
    //     while($row = $result->fetch_assoc()) {
    //         $user=array(
    //             "id" =>  $row["id"],
    //             "userename" => $row["username"],
    //             "email" => $row["email"],
    //         );
    //         array_push($users,$user);
    //     }
    //     sendResponse(200,$users,'User Details');
    // } else {
    //     sendResponse(404,[],'User not available');
    // }
    $conn->close();
}