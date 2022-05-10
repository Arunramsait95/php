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
        foreach($request as $row) {
            $parent = $row->Parent;
            $child = $row->Child;
            //  
            $sql = mysqli_query($mysqli,"SELECT * FROM Data where Parent='$parent' and Child='$child'");
                if(!$sql->num_rows >0){
                    $query = mysqli_query($mysqli, "INSERT INTO data (Parent, Child) VALUES ('$parent', '$child');");
                }
        }
    }else
    {
        http_response_code(404);
    }
?>
