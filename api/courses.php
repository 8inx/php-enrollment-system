<?php
header('Content-Type: application/json');
include('./connection.php');

$connection = connection();
$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);


/** `CREATE` Course **/

if ($post['action'] === 'create') {
    $code = strtoupper($post['code']);
    $description = $post['description'];

    $query = mysqli_query($connection, "SELECT * FROM `courses` WHERE `code`='$code'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "code", "message" => "Subject code already exist")));
    }

    $sql = "INSERT INTO `courses` (`code`,`description`) VALUES ('$code','$description')";
    mysqli_query($connection, $sql);

    echo json_encode(array("message" => "Course created successfully"));
}

/** `UPDATE` Course **/

if ($post['action'] === 'edit') {
    $id = $post['id'];
    $code = strtoupper($post['code']);
    $description = $post['description'];
    $status = $post['status'];

    $query = mysqli_query($connection, "SELECT * FROM `courses` WHERE `code`='$code'");
    $courseFromDb = mysqli_fetch_assoc($query);

    if ($id !== $courseFromDb['id'] && $code === $courseFromDb["code"]) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "code", "message" => "Course code already exist")));
    }

    $sql = "UPDATE  `courses` "
        . "SET  `code`          ='$code', "
        . "     `description`   ='$description', "
        . "     `status`        ='$status' "
        . "WHERE   `id`         ='$id'";

    mysqli_query($connection, $sql);
    echo json_encode(array("data" => $post, "message" => "Update Success"));
}

/** `DELETE` Course **/

if ($post['action'] === 'delete') {
    $id = $post['id'];
    $sql = "DELETE FROM `courses` WHERE `id`='$id'";
    mysqli_query($connection, $sql);
    echo json_encode(array("data" => $post, "message" => "Delete Success"));
}

/** `GET ALL` Courses **/

if ($get['action'] === 'all') {

    $sql = "SELECT * FROM `courses`";

    if (isset($get["status"])) {
        $status = $get["status"];
        $sql .= " WHERE `status`='$status'";
    }

    if (isset($get["size"])) {
        $size = $get["size"];
        $sql .= " LIMIT $size";
    }

    $courses = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    print json_encode(array("data" => $courses, "message" => "Get Course Success"));
}

/** `GET STATS Courses **/

if ($get['action'] === 'stats') {

    $sql = "SELECT c.*, COUNT(st.id) as 'studentCount' "
        . "FROM `courses` c "
        . "LEFT OUTER JOIN `students` st "
        . "ON c.id = st.courseId "
        . "GROUP BY c.id";

    $stats = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    print json_encode(array("data" => $stats, "message" => "Get Course Success"));
}