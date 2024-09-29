<?php
    require_once 'db_con.php';
    session_start();
    // echo $_GET['id'];
    // echo $_GET['Newname'];
    // echo $_GET['Newquantity'];
    $id=$_GET['id'];
    $Newname=$_GET['newName'];
    $Newquantity=$_GET['newquantity'];
    $Newremark=$_GET['newremark'];
    $update="UPDATE tobuy SET name='$Newname',quantity='$Newquantity', remark='$Newremark' WHERE id='$id'";
    $result = mysqli_query($link, $update);

    $_SESSION['TBupdate_completed'] = true;

    header("Location:ToBuyList_html.php");
    mysqli_close($link);
?>
