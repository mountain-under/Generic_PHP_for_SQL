<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$host = 'localhost';
$username = 'sunapp_scoredev';
$password = 'SunappDev';
$dbname = 'sunapp_basketball';
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['type'])) {
        if ($_GET['type'] === 'gameInfoCell') {
            $sql = "SELECT * FROM `gameInfoCell`";
        } elseif ($_GET['type'] === 'gamesByTeam' && isset($_GET['teamId'])) {
            $teamId = mysqli_real_escape_string($conn, $_GET['teamId']);
            $sql = "SELECT * FROM `game` WHERE `teamIdA` = '$teamId' OR `teamIdB` = '$teamId'";
        } else {
            $sql = "SELECT * FROM `game`";
        }
    } else {
        $sql = "SELECT * FROM `game`";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data, JSON_NUMERIC_CHECK);
    } else {
        echo json_encode("エラー: " . mysqli_error($conn));
    }

    mysqli_close($conn);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents("php://input"));
    $date = mysqli_real_escape_string($conn, $inputData->date);

    $sql = "SELECT * FROM `reserve_list` WHERE `reserveDate` = '$date'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data, JSON_NUMERIC_CHECK);
    } else {
        echo json_encode("エラー: " . mysqli_error($conn));
    }

    mysqli_close($conn);
    exit();
}
?>
