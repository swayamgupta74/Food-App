<?php
session_start();
require_once "C:/xampp/htdocs/final/config.php";
$item_id = $c_id =$qty=$row="";
$c_id=$_SESSION["username"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $item_id=$_POST["item_id"];
    $c_id=$_POST["c_id"];
    $qty=$_POST["qty"];
    $row=$_POST["o_id"];
    $sql2="delete from orderplaced where o_id=?";
    $sql3="update available set qty=qty+? where item_id=? and s_id=?";
    if($stmt1 = mysqli_prepare($link, $sql2) and $stmt2=mysqli_prepare($link,$sql3)){
        mysqli_stmt_bind_param($stmt1, "s", $row);
        mysqli_stmt_bind_param($stmt2, "iss", $qty,$item_id,$_SESSION["username"]);
        if(mysqli_stmt_execute($stmt1) and mysqli_stmt_execute($stmt2)){ 

            echo"order is cancelled successfully";
            header("location:s_orders.php");    
            } 
        else{
                echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt1);
        mysqli_stmt_close($stmt2);
    }
    else echo"failed";
    mysqli_close($link);
}
?>
