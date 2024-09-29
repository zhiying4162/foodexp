<?php
// 引入資料庫連線檔案
require_once 'db_con.php';

// 開啟 session
session_start();
    echo $_GET['id'];
    $id=$_GET['id'];
    $del="DELETE FROM tobuy WHERE id=$id" ;
    $result = mysqli_query($link, $del);
    header("Location:ToBuyList_html.php");
    mysqli_close($link);
?>