<?php
    require_once 'db_con.php';
    session_start();
    // echo $_GET['id'];
    // echo $_GET['Newname'];
    // echo $_GET['Newdate'];
    $id=$_GET['id'];
    $Newname=$_GET['Newname'];
    $Newdate=$_GET['Newdate'];
    $update="UPDATE myfood SET name='$Newname',date='$Newdate' WHERE id='$id'";
    $result = mysqli_query($link, $update);

    $_SESSION['update_completed'] = true;

    header("Location:Loupe_html.php");
    mysqli_close($link);
?>
