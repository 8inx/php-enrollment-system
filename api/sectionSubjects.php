<?php
header('Content-Type: application/json');
include('./connection.php');

$connection = connection();
$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);


/** `CREATE` Section-Subject **/

if ($post['action'] === 'add') {
    $sectionId = $post['sectionId'];
    $subjectId = $post['subjectId'];

    $query = mysqli_query($connection, "SELECT * FROM `sectionSubjects` WHERE `sectionId`='$sectionId' AND `subjectId`='$subjectId'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "subjectId", "message" => "Subject is already added")));
    }

    $sql = "INSERT INTO `sectionSubjects` (`sectionId`,`subjectId`) VALUES ('$sectionId','$subjectId')";
    mysqli_query($connection, $sql);

    echo json_encode(array("data" => $post, "message" => "Subject added successfully"));
}

/** `UPDATE` Section-Subject **/

if ($post['action'] === 'edit') {
    $id = $post['id'];
    $days = $post['days'];
    $timeIn = $post['timeIn'];
    $timeOut = $post['timeOut'];
    $room = $post['room'];

    $sql = "UPDATE  `sectionSubjects` "
        . "SET  `days`= COALESCE(NULLIF('$days', ''), `days` ), "
        . "     `timeIn`= COALESCE(NULLIF('$timeIn',''), `timeIn` ), "
        . "     `timeOut`= COALESCE(NULLIF('$timeOut',''), `timeOut` ), "
        . "     `room`= COALESCE(NULLIF('$room',''), `room` )  "
        . "WHERE `id`='$id'";
    $q = mysqli_query($connection, $sql);
    if (!$q) {
        die(json_encode(array("data" => mysqli_error($connection), "message" => "Edit section subject Success")));
    };

    echo json_encode(array("data" => $post, "message" => "Edit section subject Success"));
}

/** `DELETE` Section-Subject **/

if ($post['action'] === 'delete') {
    $id = $post['id'];
    $sectionId = $post['sectionId'];
    $subjectId = $post['subjectId'];

    if (isset($post['id'])) {
        $sql = "DELETE FROM `sectionSubjects` WHERE `id`='$id'";
    } else if (isset($post['sectionId']) && isset($post['subjectId'])) {
        $sql = "DELETE FROM `sectionSubjects` WHERE `subjectId`='$subjectId' AND `sectionId`='$sectionId'";
    }

    mysqli_query($connection, $sql);

    echo json_encode(array("data" => $post, "message" => "Remove subject Success"));
}

/** `FIND BY SECTION ID` Section-Subject **/

if ($get['action'] === 'getSection') {

    $sectionId = $get['sectionId'];

    $sql = "SELECT ss.*, "
        . "sub.code, sub.description, sub.units "
        . "FROM `sectionSubjects` ss "
        . "LEFT JOIN `subjects` sub "
        . "ON ss.subjectId = sub.id "
        . "WHERE ss.sectionId = '$sectionId';";

    $subjects = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    print json_encode(array("data" => $subjects, "message" => "Get Course Success"));
}