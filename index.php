<?php
require("connect.php");
$sql="SELECT * FROM qlsp";
$query= mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container-index">
        <h1>DANH MỤC SẢN PHẨM LAPTOP</h1><br>
        <a href="create.php" class="btn">Thêm Sản Phẩm</a><br>
        <div class="show-product">
            <?php while ($row = mysqli_fetch_array($query)): ?>
            <table class="ListSP">
                
                    <tr>
                        <td>
                            <img src="./images/<?= htmlspecialchars($row['imgSP'])?>" alt="Product Image">
                        </td> 
                    </tr>
                    <tr>
                        <td>
                            <p class="ten" ><?= htmlspecialchars($row['TENSP']) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="giacu-phantram">
                            <p class="giacu"><?= number_format($row['GIACU'],0,',','.') ?>đ</p>
                            <p class="phantram">-<?= htmlspecialchars($row['PHANTRAMGIAMGIA']) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="giamoi"><?= number_format($row['GIAMOI'],0,',','.') ?>đ</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="update.php?id=<?= $row['MASP'] ?>" class="btn" id="btn">Sửa</a>
                            <a class="delete" onclick="return xoasanpham()" href="delete.php?id=<?=$row['MASP']?>">Xóa</a>
                        </td>
                    </tr>
                
            </table>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
