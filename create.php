<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container-create">
    <h1>THÊM MỚI SẢN PHẨM</h1>
    <div class="input-info">
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="ten">Tên sản phẩm</label> <br>
                <input type="text" id="ten" name="ten" require>
            </div>
            <div>
                <label for="img">Hình sản phẩm</label> <br>
                <input type="file" id="file" name="img" require>
            </div>
            <div>
                <label for="giacu">Giá cũ</label> <br>
                <input type="number" id="giacu" name="giacu" require>
            </div>
            <div>
                <label for="giamoi">Giá mới</label> <br>
                <input type="number" id="giamoi" name="giamoi" require>
            </div>
            <div>
                <label for="phantramgiamgia">Phần trăm giảm giá</label> <br>
                <input type="text" id="phantramgiamgia" name="phantramgiamgia" required>
            </div>
            <button type="submit" name="submit">Thêm mới</button>   
                <a href="index.php" class="huy">Hủy</a>
        </form>
    </div>
</div>

</body>
</html>
<?php
require("connect.php");
if (isset($_POST["submit"])) {
    $tensp = $_POST["ten"];
    $giacu = $_POST["giacu"];
    $giamoi = $_POST["giamoi"];
    $imgsp = $_FILES['img']['name'];
    $phantramgiamgia = $_POST['phantramgiamgia'];

    
    $target_dir = "./images/";
    if (!is_dir(filename: $target_dir)) {
        mkdir(directory: $target_dir,permissions: 0777, recursive: true);
    }

    
    $target_file = $target_dir . basename($imgsp);

    
    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        
        $sql = "INSERT INTO qlsp (TENSP, imgSP, GIACU, GIAMOI, PHANTRAMGIAMGIA, MASP)
                VALUES ('$tensp','$imgsp', '$giacu', '$giamoi', '$phantramgiamgia',NULL)";


        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Bạn đã thêm thành công');</script>";
            header("Location: index.php");
        } else {
            echo "<script>alert('Lỗi khi thêm sản phẩm');</script>";
        }
    } else {
        echo "<script>alert('Lỗi khi tải lên hình ảnh');</script>";
    }
}
?>