<?php
require("connect.php");
if (isset($_GET['id'])) {
    $masp = (int)$_GET['id'];


    $sql = "SELECT * FROM qlsp WHERE MASP = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $masp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Không tìm thấy sản phẩm');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID sản phẩm không hợp lệ');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit;
}


if (isset($_POST['submit'])) {
    $tensp = $_POST['ten'];
    $giacu = $_POST['giacu'];
    $giamoi = $_POST['giamoi'];
    $phantramgiamgia = $_POST['phantramgiamgia'];
    $imgsp = $_FILES['img']['name'];


    $target_dir = "./images/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($imgsp);
    if (!empty($imgsp) && move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {

        $update_sql = "UPDATE qlsp SET TENSP = ?, imgSP = ?, GIACU = ?, GIAMOI = ?, PHANTRAMGIAMGIA = ? WHERE MASP = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssddsi", $tensp, $imgsp, $giacu, $giamoi, $phantramgiamgia, $masp);
    } else {

        $update_sql = "UPDATE qlsp SET TENSP = ?, GIACU = ?, GIAMOI = ?, PHANTRAMGIAMGIA = ? WHERE MASP = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sddsi", $tensp, $giacu, $giamoi, $phantramgiamgia, $masp);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật sản phẩm thành công');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật sản phẩm');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container-update">
    <h1>CẬP NHẬT SẢN PHẨM</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="ten">Tên sản phẩm</label> <br>
            <input type="text" id="ten" name="ten" value="<?= htmlspecialchars($row['TENSP']) ?>" required>
        </div>
        <div>
            <label for="img">Hình sản phẩm</label> <br>
            <input type="file" id="img" name="img">
            <img src="./images/<?= htmlspecialchars($row['imgSP']) ?>" alt="Hình sản phẩm" width="200">
            
        </div>
        <div>
            <label for="giacu">Giá cũ</label> <br>
            <input type="number" id="giacu" name="giacu" value="<?= htmlspecialchars($row['GIACU']) ?>" required>
        </div>
        <div>
            <label for="giamoi">Giá mới</label> <br>
            <input type="number" id="giamoi" name="giamoi" value="<?= htmlspecialchars($row['GIAMOI']) ?>" required>
        </div>
        <div>
            <label for="phantramgiamgia">Phần trăm giảm giá</label> <br>
            <input type="text" id="phantramgiamgia" name="phantramgiamgia" value="<?= htmlspecialchars($row['PHANTRAMGIAMGIA']) ?>" required>
        </div>
        <button type="submit" name="submit">Cập nhật</button>
        <a href="index.php" class="huy">Hủy</a>
    </form>
</div>
</body>
</html>
