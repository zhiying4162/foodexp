<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rwdd.css">
    <title>即期查詢</title>
    <style>
        .expired { background-color: #FBC3BC; }
        .soonToExpire { background-color: #ffef9f; font-size: 36px;}
        .notExpired { background-color:#C0F7A4;font-size: 36px; }
    </style>
</head>
<body>
    <div class="titArea">
        即期查詢
        <div class="Loubtn">
            <button id="Search"  onclick="ToSearch()">找尋商品</button>
            <button id="RewriteDate" onclick="Back()">回主畫面</button>
        </div>
    </div>
    <div class="button-container">
        <button class="btn" id="btn0">首頁</button>
        <button class="btn" id="btn1"><span>歷史</span><span>紀錄</span></button>
        <button class="btn" id="btn2"><span>食品</span><span>紀錄</span></button>
        <button class="btn" id="btn3"><span>購物</span><span>清單</span></button>
        <button class="btn" id="btn4"><span>即期</span><span>查詢</span></button>
        <button class="btn" id="btn5"><span>推薦</span><span>商家</span></button> 
    </div>
    <?php
// 引入資料庫連線檔案
require_once 'db_con.php';

// 開啟 session
session_start();

// 檢查是否有 'AllData' session 變數，若無，則初始化為空陣列
if (!isset($_SESSION['Data'])) {
    $_SESSION['Data'] = array();
}

// 取得所有資料庫中的資料

$productName=$_SESSION['SelproductName'];
$query = "SELECT id,name,kind, date FROM myfood WHERE name LIKE '%$productName%'ORDER BY date ASC";
$result = mysqli_query($link, $query);
// 將資料存入 session 中
$_SESSION['Data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

// 取得所有資料
$Data = $_SESSION['Data'];
if (isset($_SESSION['Data'])) {
    foreach ($_SESSION['Data'] as $product) {
        // 取得有效日期
        $expiryDate = strtotime(date('Y-m-d', strtotime($product['date'])));
        $currentDate = strtotime(date('Y-m-d'));
        $dateDifference = $expiryDate - $currentDate;
        $kindImage = "pic/" . $product['kind'] . ".png"; // 圖片路徑

        // 根據日期設置類名，控制背景顏色
        $productClass = '';
        if ($dateDifference > 0 && $dateDifference <= 3 * 24 * 60 * 60) {
            $productClass = 'warning'; // 有效期前三天
        } elseif ($dateDifference > 0) {
            $productClass = 'safe'; // 未到期
        } else {
            $productClass = 'expired'; // 已過期
        }

        // 使用預定義的樣式類來生成 HTML 結構
        echo "
        <div class='product-card $productClass'>
            <div class='product-image'>
                <img src='$kindImage' alt='" . $product['kind'] . "'>
            </div>
            <div class='product-info'>
                <p>
        品名：<span class='Arial'>" . $product['name'] . "</span>
        <span class='button-c'>
            <button class='action-btn' onclick='Rewrite(\"" . $product['id'] . "\",\"" . $product['name'] . "\",\"" . $product['date'] . "\")'>修改</button>
            <button class='action-btn' onclick=\"location.href='Ldelete.php?id=" . $product['id'] . "'\" type='button'>刪除</button>
        </span>
    </p>
                <p>有效日期：<span class='Arial'>" . $product['date'] . "</span></p>
                
            </div>
        </div>";
    }
} else {
    echo "";
}

    
    echo "<p style='#fff8dc;font-size: 36px'>"  . "<br/> <br/>". "<br/> </p>";
    ;
    
    
// 關閉資料庫連線
mysqli_close($link);
?>
 
<script src="Script.js"></script>
</body>
</html>
