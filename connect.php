<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsp";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}
$query = mysqli_query($conn, "SELECT * FROM qlsp");
if (!$query) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
?>