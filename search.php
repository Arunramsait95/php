<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");
include_once("database.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

        $search = $request->search; 
        $sql = mysqli_query($mysqli,"SELECT * FROM data where Parent=".$search);           
        $res = mysqli_fetch_array($sql);
            print_r($res);
    // }else
    // {
    //     http_response_code(404);
    // }
?>
