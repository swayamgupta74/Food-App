<?php
session_start();
require_once "C:/xampp/htdocs/final/config.php";
$item_id = $s_id ="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $item_id=$_POST["item_id"];
    $s_id=$_POST["s_id"];
    $sql="delete from available  where item_id=? and s_id=?";
    $sql1="select * from orderplaced where item_id=? and s_id=?";
    $sql2="select * from available where item_id =? and s_id!=?";
    $sql3="delete from item where item_id=?";
    if($stmt1 = mysqli_prepare($link, $sql1) ){
        mysqli_stmt_bind_param($stmt1, "ss", $item_id,$s_id);
        if(mysqli_stmt_execute($stmt1) ){ 
            mysqli_stmt_store_result($stmt1);
            $count=mysqli_stmt_num_rows($stmt1);
            } 
        else{
                echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt1);
    }
    else echo"failed";
    if($count==0){
        if($stmt2 = mysqli_prepare($link, $sql2) ){
            mysqli_stmt_bind_param($stmt2, "ss", $item_id,$s_id);
            if(mysqli_stmt_execute($stmt2) ){ 
                mysqli_stmt_store_result($stmt2);
                $flag=mysqli_stmt_num_rows($stmt2);
                } 
            else{
                    echo "Oops! Something went wrong. Please try again later.";
            }
    
            // Close statement
            mysqli_stmt_close($stmt2);
        }
        else echo"failed";
    if($stmt = mysqli_prepare($link, $sql) ){
        mysqli_stmt_bind_param($stmt, "ss", $item_id,$s_id);
        if(mysqli_stmt_execute($stmt) ){ 

            echo"Item is deleted successfully";
            header("location:s_listitem.php");    
            } 
        else{
                echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    else echo"failed";
    if($flag==0)
        {
            if($stmt3 = mysqli_prepare($link, $sql3) ){
                mysqli_stmt_bind_param($stmt3, "s", $item_id);
                if(mysqli_stmt_execute($stmt3) ){ 
                   echo "this item is deleted from item table also";
                    } 
                else{
                        echo "Oops! Something went wrong. Please try again later.";
                }
        
                // Close statement
                mysqli_stmt_close($stmt3);
            }
            else echo"failed";
        }
    }
    else{
        echo "You cannot remove this item before placing the order regarding this item";
    }
    mysqli_close($link);
}
?>
