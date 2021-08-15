<?php
session_start();
require_once "C:/xampp/htdocs/final/config.php";
$item_id = $s_id =$qty="";
$c_id=$_SESSION["username"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $item_id=$_POST["item_id"];
    $s_id=$_POST["s_id"];
    $qty=$_POST["qty"];
    $sql="update available set qty=qty+? where item_id=? and s_id=?";
    if($stmt = mysqli_prepare($link, $sql) ){
        mysqli_stmt_bind_param($stmt, "iss", $qty,$item_id,$s_id);
        if(mysqli_stmt_execute($stmt) ){ 

            echo"Qnty is updated successfully";
            header("location:s_listitem.php");    
            } 
        else{
                echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    else echo"failed";
    mysqli_close($link);
}
?>
