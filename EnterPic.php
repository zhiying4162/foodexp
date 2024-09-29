<?php
if(isset($_POST["submit"])) {
    $target_dir = "SavePic/";
    $target_file = $target_dir . basename($_FILES["photoInput"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // 檢查圖片是否為真實的圖片檔案
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photoInput"]["tmp_name"]);
        if($check !== false) {
            echo "檔案是一個 - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "檔案不是一個圖片。";
            $uploadOk = 0;
        }
    }

    // 檢查檔案是否已經存在
    if (file_exists($target_file)) {
        echo "抱歉，檔案已存在。";
        $uploadOk = 0;
    }

    // 檢查檔案大小
    if ($_FILES["photoInput"]["size"] > 5000000) {
        echo "抱歉，檔案太大。";
        $uploadOk = 0;
    }

    // 允許特定的檔案格式
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "抱歉，僅支援 JPG, JPEG, PNG & GIF 檔案。";
        $uploadOk = 0;
    }

    // 檢查 $uploadOk 是否被設為 0 表示有錯誤
    if ($uploadOk == 0) {
        echo "抱歉，檔案未上傳。";
    // 如果一切正確，嘗試上傳檔案
    } else {
        if (move_uploaded_file($_FILES["photoInput"]["tmp_name"], $target_file)) {
            echo "檔案 ". htmlspecialchars( basename( $_FILES["photoInput"]["name"])). " 已上傳。";
        } else {
            echo "抱歉，上傳檔案時發生錯誤。";
        }
    }
}
header("Location:EnterPic.html");
?>
