<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rwdd.css">
    <title>購物清單</title>
</head>
<body>
    <div class="titArea">
        購物清單
        
        <div class="Loubtn">
                <button id="SearchBuy" onclick="backtolist()">回主畫面</button>
                <!-- <button id="searchButton" onclick="searchBuy()">尋找商品</button> -->

                <button id="Add" onclick="addBuy()">新增商品</button>
            <!-- <button id="Add">新增商品</button> -->
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
<table border="1">
<?php
require_once 'db_con.php';
echo "<tr align=center><td> 檢核 </td><td>品名</td><td>數量</td><td>備註</td><td>修改</td><td>刪除</td></tr>" ;

session_start();

if (!isset($_SESSION['TBData'])) {
    $_SESSION['TBData'] = array();
}
$TBproductName=$_GET['TBproductName'];
$_SESSION['TBproductName']=$_GET['TBproductName'];

$query="SELECT id,name,quantity,remark FROM tobuy WHERE name LIKE '%$TBproductName%'";

$result = mysqli_query($link, $query);
$_SESSION['TBData'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach ($_SESSION['TBData'] as $buy) {
    echo "<tr align=center><td><input type='checkbox' class='myCheckbox' data-id='" . $buy['id'] . "' onchange='changeRowColor(this)'></td>";
    echo "<td style='font-size: 30px;'>" .$buy['name']. "</td>";
    echo "<td style='font-size: 30px;'>" .$buy['quantity']. "</td>";
    echo "<td style='font-size: 30px;'>" .$buy['remark']. "</td>";
    echo "<td><button style='font-size: 20px;background-color: #fff8dc;box-shadow: 2px 2px 3px #888888; border: 1px solid #ffffff;' onclick='TBRewrite(\"" . $buy['id'] . "\",\"" . $buy['name'] . "\",\"" . $buy['quantity'] . "\",\"" . $buy['remark'] . "\")'>修改</button></td>";
    echo "<td><button style='font-size: 20px;background-color: #fff8dc;box-shadow: 2px 2px 3px #888888; border: 1px solid #ffffff;'' onclick=\"location.href='TBdelete.php?id=" . $buy['id'] . "'\">刪除</button></td></tr>";
             
}
?>
</table>
<p style='#fff8dc;font-size: 36px'><br/> <br/><br/> </p>
<div class="top-button" onclick="scrollToTop()">TOP</div>
<script src="Script.js"></script>
</body>
</html>