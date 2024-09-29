<?php
$target_dir = "uploads/"; // 設定上傳目錄
$target_file = $target_dir . basename($_FILES["photoInput"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// 檢查是否為真實的圖片
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photoInput"]["tmp_name"]);
    if($check !== false) {
        echo "檔案是一個有效的圖片 - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "檔案不是一個有效的圖片.";
        $uploadOk = 0;
    }
}

// 檢查檔案是否已經存在
if (file_exists($target_file)) {
    echo "抱歉，檔案已經存在。";
    $uploadOk = 0;
}

// 檢查檔案大小
if ($_FILES["photoInput"]["size"] > 500000) {
    echo "抱歉，檔案太大。";
    $uploadOk = 0;
}

// 允許特定的檔案格式
$allowed_extensions = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowed_extensions)) {
    echo "抱歉，只允許 JPG, JPEG, PNG & GIF 檔案.";
    $uploadOk = 0;
}

// 如果 $uploadOk 為 0，上傳失敗
if ($uploadOk == 0) {
    echo "檔案未上傳。";
// 如果一切都正確，儲存檔案
} else {
    if (move_uploaded_file($_FILES["photoInput"]["tmp_name"], $target_file)) {
        echo "檔案 ". htmlspecialchars(basename($_FILES["photoInput"]["name"])). " 已成功上傳。";
    } else {
        echo "抱歉，上傳檔案時發生錯誤。";
    }
}
?>
