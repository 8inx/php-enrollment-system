<?php

header('Content-Type: application/json');

include('./connection.php');

$connection = connection();

$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);


/** `CREATE` section **/

if ($post['action'] === 'create') {
    $code = strtoupper($post['code']);
    $maxStudents = $post['maxStudents'];

    $query = mysqli_query($connection, "SELECT * FROM `sections` WHERE `code`='$code'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "code", "message" => "Section code already exist")));
    }

    $sql = "INSERT INTO `sections` (`code`,`maxStudents`) VALUES ('$code','$maxStudents')";
    mysqli_query($connection, $sql);

    echo json_encode(array("message" => "Section created successfully"));
}

/** `UPDATE` section **/

if ($post['action'] === 'edit') {
    $id = $post['id'];
    $code = strtoupper($post['code']);
    $maxStudents = $post['maxStudents'];

    $query = mysqli_query($connection, "SELECT * FROM `sections` WHERE `code`='$code'");
    $sectionFromDb = mysqli_fetch_assoc($query);

    if ($id !== $sectionFromDb['id'] && $code === $sectionFromDb["code"]) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "code", "message" => "Section code already exist")));
    }

    $sql = "UPDATE  `sections` "
        . "SET  `code`         ='$code', "
        . "     `maxStudents`  ='$maxStudents' "
        . "WHERE   `id`        ='$id'";

    mysqli_query($connection, $sql);
    echo json_encode(array("data" => $post, "message" => "Update Success"));
}

/** `DELETE` section **/

if ($post['action'] === 'delete') {
    $id = $post['id'];
    $sql = "DELETE FROM `sections` WHERE `id`='$id'";
    mysqli_query($connection, $sql);
    echo json_encode(array("data" => $post, "message" => "Delete Success"));
}

/** `FIND ALL` section **/

if ($get['action'] === 'all') {

    $sql = "SELECT sec.*, "
        . "(SELECT COUNT(ss.id) as 'subjCount' FROM `sectionSubjects` ss WHERE ss.sectionId = sec.id) as 'subjCount', "
        . "(SELECT COUNT(en.id) as 'subjCount' FROM `enrollments` en WHERE en.sectionId = sec.id) as 'participantsCount' "
        . "FROM `sections` sec";

    $sections = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    print json_encode(array("data" => $sections, "message" => "Get Course Success"));
}

/** `FIND ONE` section **/

if ($get['action'] === 'findOne') {
    $id = $get["id"];

    $sql = "SELECT * FROM `sections` WHERE `id`='$id'";

    $sections = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    print json_encode(array("data" => $sections, "message" => "Get Course Success"));
}
