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
            <button id="Search" onclick="Back()">找尋商品</button>
            <button id="RewriteDate" onclick="ToDoSel()">改寫資料</button>
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
    require_once 'db_con.php';
    session_start();
    if (!isset($_SESSION['Data'])) {
        $_SESSION['Data'] = array();
    }
    
    //  echo $_GET['productName'];
    $productName=$_GET['productName'];
    $_SESSION['SelproductName']=$_GET['productName'];
    $query = "SELECT id,name,kind,date FROM myfood WHERE name LIKE '%$productName%'ORDER BY date ASC";
    $result = mysqli_query($link, $query);
    $_SESSION['Data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

// 取得所有資料
$Data = $_SESSION['Data'];
if (isset($_SESSION['Data'])) {
    foreach ($_SESSION['Data'] as $product) {
        $expiryDate = strtotime(date('Y-m-d', strtotime($product['date'])));
        $currentDate = strtotime(date('Y-m-d'));
        $dateDifference = $expiryDate - $currentDate;
        $kindImage =  "pic/" . $product['kind'] . ".png"; // 替換為實際的圖片路徑
        $class = '';

        if ($dateDifference > 0 && $dateDifference <= 3 * 24 * 60 * 60) {
            $class = 'warning';
        } elseif ($dateDifference > 0) {
            $class = 'safe';
        } else {
            $class = 'expired';
        }

        echo "
        <div class='product-card $class'>
            <div class='product-image'>
                <img src='$kindImage' alt='". $product['kind']. "'>
            </div>
            <div class='product-info'>
                <p>品名：<span class='Arial'>" . $product['name'] . "</span></br>有效日期：<span class='Arial'>" . $product['date'] . "</span></p>
            </div>
        </div>
        ";
    }
} else {
    echo "";
}

echo "<p style='#fff8dc;font-size: 36px'>"  . "<br/> <br/>". "<br/> </p>";

    mysqli_close($link);
?>
 
 <script src="Script.js"></script>
</body>
</html>