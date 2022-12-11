<?php

header('Content-Type: application/json');

include('./connection.php');

$connection = connection();

$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);



/** `CREATE` Subject **/

if ($post['action'] === 'create') {
    $code = strtoupper($post['code']);
    $description = $post['description'];
    $units = $post['units'];

    $query = mysqli_query($connection, "SELECT * FROM `subjects` WHERE `code`='$code'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "code", "message" => "Subject code already exist")));
    }

    $sql = "INSERT INTO `subjects` (`code`,`description`,`units`) VALUES ('$code','$description','$units')";
    mysqli_query($connection, $sql);

    echo json_encode(array("message" => "Subject created successfully"));
}

/** `UPDATE` Subject **/

if ($post['action'] === 'edit') {
    $id = $post['id'];
    $code = strtoupper($post['code']);
    $description = $post['description'];
    $units = $post['units'];

    $query = mysqli_query($connection, "SELECT * FROM `subjects` WHERE `code`='$code'");
    $subjectFromDb = mysqli_fetch_assoc($query);

    if ($id !== $subjectFromDb['id'] && $code === $subjectFromDb["code"]) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "code", "message" => "Subject code already exist")));
    }

    $sql = "UPDATE  `subjects` "
        . "SET  `code`         ='$code', "
        . "     `description`  ='$description', "
        . "     `units`        ='$units' "
        . "WHERE   `id`        ='$id'";

    mysqli_query($connection, $sql);
    echo json_encode(array("data" => $post, "message" => "Update Success"));
}

/** `DELETE` Subject **/

if ($post['action'] === 'delete') {
    $id = $post['id'];
    $sql = "DELETE FROM `subjects` WHERE `id`='$id'";
    mysqli_query($connection, $sql);
    echo json_encode(array("data" => $post, "message" => "Delete Success"));
}

/** `FIND ALL` Subject **/
if ($get['action'] === 'all') {

    $sql = "SELECT * FROM `subjects`";

    if (isset($get["size"])) {
        $size = $get["size"];
        $sql .= " LIMIT $size";
    }

    $subjects = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    print json_encode(array("data" => $subjects, "message" => "Get Course Success"));
}

/** `GET ALL BY SECTION ID` Subject **/

if ($get['action'] === 'avail') {

    $sectionId = $get['sectionId'];

    $sql = "SELECT sub.*, "
        . "CASE WHEN EXISTS ("
        . "SELECT * FROM `sectionSubjects` ss "
        . "WHERE ss.subjectId = sub.id AND ss.sectionId = '$sectionId' "
        . ") THEN 1 ELSE 0 "
        . "END as 'exists' "
        . "FROM `subjects` sub";


    $subjects = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    print json_encode(array("data" => $subjects, "sectionId" => $sectionId, "message" => "Get Course Success"));
}
