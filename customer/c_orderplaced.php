<?php
session_start();
require_once "config.php";
$item_id = $s_id =$qty="";
$c_id=$_SESSION["username"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $item_id=$_POST["item_id"];
    $s_id=$_POST["s_id"];
    $qty=$_POST["qty"];
    $row=date("y/m/d//H-i-s");
    $sql2="insert into orderplaced (o_id,item_id,s_id,c_id,qty) values(?,?,?,?,?)";
    $sql3="update available set qty=qty-? where item_id=? and s_id=?";
    if($stmt1 = mysqli_prepare($link, $sql2) and $stmt2=mysqli_prepare($link,$sql3)){
        mysqli_stmt_bind_param($stmt1, "ssssi", $row,$item_id,$s_id,$c_id,$qty);
        mysqli_stmt_bind_param($stmt2, "iss", $qty,$item_id,$s_id);
        if(mysqli_stmt_execute($stmt1) and mysqli_stmt_execute($stmt2)){ 

            echo"order is placed successfully";
            header("location:c_dashboard.php");    
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