<?php
header('Content-Type: application/json');
include('./connection.php');

$connection = connection();
$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);


/** `CREATE` Enrollment **/

if ($post['action'] === 'create') {
    $studentId = $post['studentId'];

    $query = mysqli_query($connection, "SELECT * FROM `students` WHERE `id`='$studentId'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows === 0) {
        header("HTTP/1.1 404 Not Found");
        die(json_encode(array("path" => "studentId", "message" => "Student doesn't exist")));
    }

    $query = mysqli_query($connection, "SELECT * FROM `enrollments` WHERE `studentId`='$studentId' AND `status`='ongoing'");
    $num_rows = mysqli_num_rows($query);

    if ($num_rows) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "studentId", "message" => "This student have 1 ongoing enrollment")));
    }

    $result = mysqli_query($connection, "INSERT INTO `enrollments` (`studentId`) VALUES ('$studentId')");
    $insertedId = mysqli_insert_id($connection);
    echo json_encode(array("data" => array("id" => $insertedId), "message" => "Enrollment start"));
}

/** `UPDATE` Enrollment **/

if ($post['action'] === 'edit') {
    $id = $post['id'];
    $sectionId = $post['sectionId'];
    $studentId = $post['studentId'];
    $semester = $post['semester'];
    $year = $post['year'];
    $status = $post['status'];
    $dateEnrolled = $post['dateEnrolled'];


    $sql = "SELECT * FROM `enrollments` WHERE `studentId`='$studentId'";
    $enrollmentFromDb = mysqli_fetch_assoc(mysqli_query($connection, $sql));

    if ($enrollmentFromDb['id'] !== $id) {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "sectionCode", "message" => "You already joined this section")));
    }


    $sql = "SELECT * FROM `enrollments` WHERE `semester`='$semester' AND `year`='$year' AND `studentId`='$studentId'";
    $enrollmentFromDb =  mysqli_fetch_assoc(mysqli_query($connection, $sql));

    if ($enrollmentFromDb['status'] === 'completed') {
        header("HTTP/1.1 409 Conflict");
        die(json_encode(array("path" => "semester", "message" => "This student have completed enrollment in this semester")));
    }

    if ($status === 'completed') {
        $dateEnrolled = date("Y-m-d H:i:s");
    }

    $sql = "UPDATE  `enrollments` "
        . "SET  `year`= COALESCE(NULLIF('$year', ''), `year` ), "
        . "     `semester`= COALESCE(NULLIF('$semester',''), `semester` ), "
        . "     `sectionId`= COALESCE(NULLIF('$sectionId',''), `sectionId` ),  "
        . "     `status`= COALESCE(NULLIF('$status',''), `status` ),  "
        . "     `dateEnrolled`= COALESCE(NULLIF('$dateEnrolled',''), `dateEnrolled` )  "
        . "WHERE `id`='$id'";

    $query = mysqli_query($connection, $sql);
    echo json_encode(array("data" => $post, "message" => "Updated successfully"));
}

/** `DELETE` Enrollment **/

if ($post['action'] === 'delete') {
    $id = $post['id'];
    $sql = "DELETE FROM `enrollments` WHERE `id`='$id'";
    mysqli_query($connection, $sql);
    echo json_encode(array("data" => null, "message" => "Delete Success"));
}

/** `FIND ALL` Enrollment **/

if ($get['action'] === 'all') {

    $sql = "SELECT * FROM `enrollments`";

    if($get['latest']){
        $sql = "SELECT en.*, CONCAT(st.firstName, ' ', st.lastName) as 'fullName', MAX(en.dateCreated) as 'startEnroll', MAX(en.dateEnrolled) as 'lastEnrolled'"
            . "FROM `enrollments` en "
            . "LEFT OUTER JOIN `students` st "
            . "ON en.studentId = st.id "
            . "GROUP BY st.id";
    }

    if($get['status']){
        $status = $get['status'];
        $sql = "SELECT * FROM `enrollments` WHERE `status` = '$status'";
    }

    $enrollments = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    print json_encode(array("data" => $enrollments, "message" => "Get Enrollments Success"));
}

/** `FIND ONE` Enrollment **/

if ($get['action'] === "findOne") {
    $id = $get['id'];
    $sql = "SELECT en.*, st.firstName, st.lastName, CONCAT(st.firstName,' ',st.lastName) as 'fullName', st.courseId, c.code, c.description as 'courseDescription',  sec.code as 'sectionCode' "
        . "FROM `enrollments` en "
        . "LEFT OUTER JOIN `students` st "
        . "ON en.studentId = st.id "
        . "LEFT OUTER JOIN `courses` c "
        . "ON st.courseId = c.id "
        . "LEFT OUTER JOIN `sections` sec "
        . "ON en.sectionId = sec.id "
        . "WHERE en.id='$id';";

    $enrollments = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    print json_encode(array("data" => $enrollments, "message" => "Get Enrollment Success"));
}

/** `STATS` Enrollment **/

if ($get['action'] === 'stats') {
    $sql = "SELECT y.year, COUNT(en.id) as 'count' "
        . "FROM ( SELECT YEAR(CURDATE())-t.0 as 'year' "
        . "FROM (select 0 union all select 1 union all select 2 union all select 3 union all select 4 union all select 5) t GROUP BY t.0 "
        . ") y "
        . "LEFT OUTER JOIN `enrollments` en "
        . "ON YEAR(en.dateEnrolled) = y.year "
        . "GROUP BY y.year";

    $stats = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    print json_encode(array("data" => $stats, "message" => "Get Enrollment Stats Success"));
}