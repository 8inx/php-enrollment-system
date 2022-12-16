<?php

session_start();

header('Content-Type: application/json');
$post = filter_input_array(INPUT_POST);

if($post['action']==='login') {
    $accountname = $_POST['accountname'];
    $password = $_POST['password'];

    $conn = mysqli_connect($config['dbHost'], $accountname, $password);

    if(mysqli_connect_errno()){
        header("HTTP/1.1 404 Internal Server Error");
        die(json_encode(array('message' => 'User not found')));
    }else {
        $_SESSION['accountname'] = $accountname;
        echo json_encode(array("message" => "Login successfully"));
    }

    mysqli_close($conn);
}

if($post['action']==='logout') {
    unset($_SESSION['accountname']);
    echo json_encode(array("message" => "Logout successfully"));
}