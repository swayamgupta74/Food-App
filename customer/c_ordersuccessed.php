<?php
session_start();
require_once "config.php";
$item_id = $s_id =$qty=$row="";
$c_id=$_SESSION["username"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $item_id=$_POST["item_id"];
    $s_id=$_POST["s_id"];
    $qty=$_POST["qty"];
    $row=$_POST["o_id"];
    $sql2="delete from orderplaced where o_id=?";
    if($stmt1 = mysqli_prepare($link, $sql2) ){
        mysqli_stmt_bind_param($stmt1, "s", $row);
        if(mysqli_stmt_execute($stmt1) ){ 

            echo"order is deliverd successfully";
            header("location:c_orders.php");    
            } 
        else{
                echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt1);
    }
    else echo"failed";
    mysqli_close($link);
}
?>