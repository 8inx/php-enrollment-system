<?php
$config = include(__DIR__ . '/../config.php');
$hostname = $config['hostname'];
$username = $config['username'];
$password = $config['password'];
$database = $config['database'];

$accName = $config['accountUsername'];
$accPass = $config['accountPassword'];


$conn = new mysqli($hostname, $username, $password);

if (mysqli_connect_errno()) {
    die(json_encode(array('message' => 'Internal Server Error')));
}

// CREATE DATABASE;
$sql = file_get_contents('./sql/database.sql');
$sql .= file_get_contents('./sql/tables.sql');
$sql .= file_get_contents('./sql/user.sql');
$sql = str_replace(':database', $database, $sql);
$sql = str_replace(':hostname', $hostname, $sql);
$sql = str_replace(':user', $accName, $sql);
$sql = str_replace(':password', $password, $sql);

if (mysqli_multi_query($conn, $sql)) {
    $tables = array();
    do {
        /* store first result set */
        if ($result = mysqli_store_result($conn)) {
            while ($row = mysqli_fetch_row($result)) {
                array_push($tables, $row[0]);
            }
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($conn));
} else {
    die(json_encode(array('message' => 'Internal Server Error')));
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup</title>
    <!-- icons -->
    <link rel="stylesheet" href="../vendor/fontawesome/css/all.css">
    <style>
        body {
            font-family: "Inter";
            color: #1e293b;
        }

        #page {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 80px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px 16px;
        }

        th {
            vertical-align: top;
            text-align: left;
        }


        a {
            text-decoration: none;
            color: #3b82f6;
        }

        


        .flex {
            display: flex;
            flex-direction: column;
        }

        .flex span {
            padding-bottom: 4px;
        }

    </style>
</head>

<body>
    <?php if (isset($tables)) : ?>
        <div id="page">
            <table style="width:60%">
                <tr>
                    <th>Database</th>
                    <td><?= $database ?></td>
                </tr>
                <tr>
                    <th>Created Tables</th>
                    <td>
                        <div class="flex">
                            <?php
                            foreach ($tables as $t) {
                                echo "<span>$t</span>";
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>New Account Name</th>
                    <td><?=$accName?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="../public">Redirect to Sign In Page <i class="fa-solid fa-right-to-bracket"></i></a>
                    </td>
                </tr>
            </table>
        </div>
    <?php endif ?>
</body>

</html>