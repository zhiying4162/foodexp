<?php
require_once 'db_con.php';

$kind = isset($_POST['kind']) ? $_POST['kind'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'asc';

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM history";
if ($kind !== "") {
    $query .= " WHERE kind = ?";
}
$query .= " ORDER BY date $sort";

$stmt = mysqli_prepare($link, $query);
if ($kind !== "") {
    mysqli_stmt_bind_param($stmt, 's', $kind);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$response = '';

while ($product = mysqli_fetch_assoc($result)) {
    $expiryDate = strtotime($product['date']);
    $currentDate = strtotime(date('Y-m-d'));
    $dateDifference = $expiryDate - $currentDate;
    $kindImage =  "pic/".$product['kind'] . ".png"; // 替換為你實際的圖片路徑
    $class = '';
    if ($dateDifference > 0 && $dateDifference <= 3 * 24 * 60 * 60) {
        continue;
    } elseif ($dateDifference > 0) {
        continue;
    } else {
        $class = 'expired';
    }

    $response .= "
     <div class='product-card $class'>
                    <div class='product-image'>
                        <img src='$kindImage' alt='". $product['kind']. "'>
                    </div>
                    <div class='product-info'>
                        <p>品名： <span class='Arial'>" . $product['name'] . "</span></br>有效日期： <span class='Arial'>" . $product['date'] . "</span></p>
                    </div>
                </div>
    ";

}

echo $response;
echo "<p style='#fff8dc;font-size: 36px'>"  . "<br/> <br/>". "<br/> </p>";
mysqli_stmt_close($stmt);
mysqli_close($link);
?>
