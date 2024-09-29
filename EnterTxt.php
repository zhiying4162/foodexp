<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>食品紀錄</title>
        </head>
        <body>
           <?php
            require_once 'db_con.php';
           session_start();
           if (!isset($_SESSION['AllData'])) {
            $_SESSION['AllData'] = array();
        }
        
        if (isset($_POST['productName']) && isset($_POST['expiryDate'])) {
            $productName = $_POST['productName'];
            $expiryDate = $_POST['expiryDate'];
            $kind=$_POST['kind'];
            $master = "INSERT INTO myfood (name,kind,date) VALUES ('$productName', '$kind','$expiryDate')";
            $mas = "INSERT INTO history (name,kind,date) VALUES ('$productName', '$kind', '$expiryDate')";
            $result = mysqli_query($link, $master);
            $res = mysqli_query($link, $mas);
           
            // 將新的資料加入陣列
            $_SESSION['AllData'][] = array('productName' => $productName, 'kind' => $kind,'expiryDate' => $expiryDate);
        }

        if (!empty($_SESSION['AllData'])) {
            $latestData = end($_SESSION['AllData']);
            echo "品名：" . $latestData['productName'] . "<br/>有效日期：" . $latestData['expiryDate'];
            print_r ($_SESSION['AllData'][0]);
        }
        
        mysqli_close($link);
        header("Location:EnterTxt.html");
?> 
            </body>
            </html>
