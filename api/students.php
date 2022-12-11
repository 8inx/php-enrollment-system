<?php
header('Content-Type: application/json');
include('./connection.php');

$connection = connection();
$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);


/** `CREATE` Student **/

if ($post['action'] === 'create') {
    $email = $post["email"];
    $gender = $post["gender"];
    $firstName = $post["firstName"];
    $lastName = $post["lastName"];
    $courseId = $post["courseId"];

    $query = mysqli_query($connection, "SELECT * FROM `students` WHERE `email`='$email'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "email", "message" => "Email is already taken")));
    }

    $sql = "INSERT INTO `students` (`firstName`, `lastName`, `courseId`, `email`, `gender`) 
            VALUES ('$firstName', '$lastName', '$courseId', '$email', '$gender')";

    mysqli_query($connection, $sql);
    echo json_encode(array("message" => "Created student successfully"));
}

/** `UPDATE` Student **/

if ($post['action'] === 'edit') {
    $id = $post["id"];
    $email = $post["email"];
    $gender = $post["gender"];
    $firstName = $post["firstName"];
    $lastName = $post["lastName"];
    $courseId = $post["course"];

    $query = mysqli_query($connection, "SELECT * FROM `students` WHERE `email`='$email'");
    $studentFromDb = mysqli_fetch_assoc($query);

    if ($id !== $studentFromDb['id'] && $email === $studentFromDb["email"]) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "email", "message" => "Email is already taken")));
    }

    $sql = "UPDATE  `students` "
        . "SET  `email`     ='$email', "
        . "     `gender`    ='$gender', "
        . "     `firstName` ='$firstName', "
        . "     `lastName`  ='$lastName', "
        . "     `courseId`  ='$courseId' "
        . "WHERE   `id`        ='$id'";

    mysqli_query($connection, $sql);
    echo json_encode(array("data" => $sql, "message" => "Update Success"));
}

/** `DELETE` Student **/

if ($post['action'] === 'delete') {
    $id = $post['id'];
    $sql = "DELETE FROM `students` WHERE `id`='$id'";
    mysqli_query($connection, $sql);
    echo json_encode(array("data" => $post, "message" => "Delete Success"));
}

/** `FIND ALL` Student **/

if ($get['action'] === 'all') {

    $sql = "SELECT s.*, "
        . "c.code as 'course', "
        . "c.description as 'courseDescription', "
        . "MAX(e.dateEnrolled) as 'lastEnrolled' "
        . "FROM `students` s "
        . "LEFT OUTER JOIN `courses` c "
        . "ON s.courseId = c.id "
        . "LEFT OUTER JOIN `enrollments` e "
        . "ON s.id = e.studentId AND e.status = 'completed' "
        . "GROUP BY s.id "
        . "ORDER BY s.dateCreated DESC";

    if (isset($get["size"])) {
        $size = $get["size"];
        $sql .= " LIMIT $size";
    }

    $students = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    echo json_encode(array("data" => $students, "message" => "Get Student Success"));
}

/** `SEARCH` Student **/

if ($post['action'] === 'search') {
    $text = strtolower($post['text']);
    $sql = "SELECT  * FROM `students` WHERE LOWER(CONCAT(`firstName`,' ', `lastName`)) LIKE '%$text%'";

    $students = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    echo json_encode(array("data" => $students, "message" => "Success"));
}
