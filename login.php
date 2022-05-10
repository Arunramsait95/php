<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");
include_once("database.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    // to check postdata
    if(isset($postdata) && !empty($postdata))
    {
        $pwd = mysqli_real_escape_string($mysqli, trim($request->password));
        $password = md5($pwd);
        $email = mysqli_real_escape_string($mysqli, trim($request->email));
        //  
        $sql = "SELECT * FROM users where email='$email' and password='$password'";
        if($result = mysqli_query($mysqli,$sql))
        {
            // $rows = array();
            $row = mysqli_fetch_array($result);
            http_response_code(200);
            echo json_encode($row);
        }
        else
        {   
            // echo json_encode($data=["Status": 'Invalid'])
            http_response_code(404);
        }
    }
?>
