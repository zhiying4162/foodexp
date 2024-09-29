<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>即期查詢</title>
        </head>
        <body>
        <table border="1">
           <?php

        // 引入資料庫連線檔案
        require_once 'db_con.php';

        // 開啟 session

        // 启动或者恢复会话
        session_start();
        
        // 检查上次执行的时间是否已经过了一天
        if (!isset($_SESSION['last_execution']) || $_SESSION['last_execution'] < strtotime('yesterday')) {
            // 这里执行需要在每天执行的操作
        
            // 引入数据库连接文件
            require_once 'db_con.php';
        
            // 检查是否有 'AllData' session 变量，若无，初始化为空数组
            if (!isset($_SESSION['AllData'])) {
                $_SESSION['AllData'] = array();
            }
        
            // 从数据库中获取所有数据
            $query = "SELECT * FROM myfood";
            $result = mysqli_query($link, $query);
        
            // 将数据存入 session 中
            $_SESSION['AllData'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
            // 关闭数据库连接
            mysqli_close($link);
        
            // 更新上次执行的时间为当前时间
            $_SESSION['last_execution'] = time();
        }
        
        // 从 session 中获取所有数据
        $allData = $_SESSION['AllData'];
        
        // 载入 HTML 文件
        include 'Loupe_html.php';
        ?>
        
  // 載入 HTML 檔案
  include 'Loupe_html.php';
?> 
</table>
            </body>
            </html>
