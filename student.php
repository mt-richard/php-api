<?php

require_once('dbconnection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = file_get_contents('php://input');
    $obj = json_decode($data);
    var_dump($obj);
    // echo json_encode($data);
    $userData = [
        "name" =>$obj->name,
        "regno" =>$obj->regno,
        "email" =>$obj->email,
        "department" =>$obj->department];
    $db = new dbconnection();
    $result = $db->save("student", $userData);
    $response = ["message"=>"Failed to add student".$result, "status"=>0];
    if(is_int($result)){
        $response = ["message"=>"record added", "status" =>1, "id"=>$result];
    }
    echo (json_encode($response));
}

?>