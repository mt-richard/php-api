<?php
// echo $_SERVER['REQUEST_METHOD'];
require_once('dbconnection.php');
switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":
        // echo "POST working";
        $data = file_get_contents('php://input');
        $obj = json_decode($data);
        var_dump($obj);
        // echo json_encode($data);
        $userData = [
            "name" =>$obj->name,
            "phone" =>$obj->phone,
            "email" =>$obj->email,
            "password" =>md5($obj->password)];
        $db = new dbconnection();
        $result = $db->save("users", $userData);
        $response = ["message"=>"Failed to Save".$result, "status"=>0];
        if(is_int($result)){
            $response = ["message"=>"User added", "status" =>1, "id"=>$result];
        }
        echo (json_encode($response));
        break;

    case "GET":
        // echo "GET working";
        $db = new dbconnection();
        // var_dump($db->getAll("users"));
        echo json_encode($db->getAll("users"));
        break;

    case "PUT":
        echo "PUT working";
        break;

    case "PATCH":
        echo "PACH working";
        break;

    case "DELETE":
        // echo "DELETE working";
        $db = new dbconnection();
        echo json_encode($db->destroy("users"));
        break;

    default:
        echo "Nothing you done";
        break;
}


?>