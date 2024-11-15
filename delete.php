<?php
require("connect.php");
$id = (int) $_GET['id'];

$image = "SELECT imgSP FROM qlsp WHERE MASP = $id";
$query = mysqli_query($conn, $image);
$after = mysqli_fetch_assoc($query);

if (file_exists("./images/" . $after['imgSP'])) {
    unlink("./images/" . $after['imgSP']);
}

$sql = "DELETE FROM qlsp WHERE MASP = $id";
mysqli_query($conn, $sql);

header("Location: index.php");
?>