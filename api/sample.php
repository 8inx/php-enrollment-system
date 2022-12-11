
<?php

header('Content-Type: application/json');

include('./connection.php');

$connection = connection();

$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);

if ($get['action'] === 'edit') {
    $days = array();
    foreach ($post['days'] as $item) {
        array_push($item);
        // query to delete where item = $item
    }
    echo json_encode(array("data" => $days, "message" => "Created student successfully"));
}

if ($get['action'] === 'all') {
    $sql = "SELECT * FROM `sample`";
    $resdata = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    echo json_encode(array("data" => $resdata, "message" => "Created student successfully"));
}
