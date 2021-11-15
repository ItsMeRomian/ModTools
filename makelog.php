<?php
function createLog($_logType, $_userId, $_value, $_details = null)
{
    $conn = new mysqli("localhost", "root", "mijnkreft", "modtools");
    $logType = $conn->real_escape_string($_logType);
    $userId = $conn->real_escape_string($_userId);
    $value = $conn->real_escape_string($_value);
    $details = $conn->real_escape_string($_details);
    $dateTime = date('Y-m-d H:i:s');
    $sql = "INSERT INTO logs (log_type, user_id, value, details, timestamp) VALUES ('$logType', '$userId', '$value', '$details', '$dateTime')";
    $result = $conn->query($sql);
    if ($result == '0') {
        print_r($conn);
        print_r($sql);
        print_r($result);
        die("died while trying to create log.");
    }
}
