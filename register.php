<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");
include_once("database.php");
// to get post data
$postdata = file_get_contents("php://input");
// print_r($postdata);die;
    if(isset($postdata) && !empty($postdata))
    {
        $request = json_decode($postdata);
        $name = trim($request->username);
        $pwd = mysqli_real_escape_string($mysqli, trim($request->pwd));
        $password = md5($pwd);
        $email = mysqli_real_escape_string($mysqli, trim($request->email));
        $sql = "INSERT INTO users(username,password,email) VALUES ('$name','$password','$email')";
        if ($mysqli->query($sql) === TRUE) {
            $authdata = [
            'username' => $name,
            'pwd' => '',
            'email' => $email,
            'Id' => mysqli_insert_id($mysqli)
            ];
            echo json_encode($authdata);
        }else{
            http_response_code(404);
        }
}

?>