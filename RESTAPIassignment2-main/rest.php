<?php
$servername = "brighton";
$username = "jmb181_commentuser";
$password = "str0ngpassw0rd";
$db = "jmb181_VAMuseumComments";

$mysqli = new mysqli($servername, $username, $password, $db);

if ($mysqli->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    exit();
} else {
    print("successful!");
}

$mysqli->close();
?>