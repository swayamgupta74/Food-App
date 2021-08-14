<?php
session_start();
require_once "config.php";
$item_id = $item_name=$price=$company=$origin =$qty="";
$s_id=$_SESSION["username"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $item_id=$_POST["item_id"];
    $qty=$_POST["qty"];
    $item_name=$_POST["item_name"];
    $company=$_POST["company"];
    $origin=$_POST["origin"];
    $price=$_POST["price"];
    $flag1=1;
    $flag2=1;
    $sql2="select * from available as a,item as i where i.item_id=a.item_id and a.s_id=? and i.item_name=? and i.price=? and i.company_name=? and i.origin=?";
    $sql3="select * from item where item_name=? and price=? and company_name=? and origin=?";
    if($stmt2 = mysqli_prepare($link, $sql2) and $stmt3 = mysqli_prepare($link, $sql3)){
        mysqli_stmt_bind_param($stmt2, "ssiss", $s_id,$item_name,$price,$company,$origin);
        mysqli_stmt_bind_param($stmt3, "siss",$item_name,$price,$company,$origin);
        if(mysqli_stmt_execute($stmt2)   ){ 
                mysqli_stmt_store_result($stmt2);
                $flag1=mysqli_stmt_num_rows($stmt2);
                echo "$flag1";
                
            } 
        else{
                echo "1Oops! Something went wrong. Please try again later.";
        }
        if( mysqli_stmt_execute($stmt3)  ){ 
            mysqli_stmt_store_result($stmt3);
            $flag2=mysqli_stmt_num_rows($stmt3);
            mysqli_stmt_bind_result($stmt3,$col1,$col2,$col3,$col4,$col5);
            echo "$flag2";
            mysqli_stmt_fetch($stmt3);
            if($flag2!=0) $item_id=$col1;
            
        } 
        else{
            echo "4Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt3);
    }
    else echo "failed";
    $sql="insert into item (item_id,item_name,price,company_name,origin) values(?,?,?,?,?)";
    $sql1="insert into available (item_id,s_id,qty,type) values(?,?,?,?)";
    if($flag1!=0) echo "this item is already present at your shop";
    if($flag1==0 and $flag2!=0){
        if( $stmt1 = mysqli_prepare($link, $sql1)  ){
            mysqli_stmt_bind_param($stmt1,"ssis",$item_id,$s_id,$qty,$item_name );
            if(mysqli_stmt_execute($stmt1)  ){ 
    
                echo"item is added successfully";
                header("location:s_dashboard.php");    
                } 
            else{
                    echo "2Oops! Something went wrong. Please try again later.";
            }
    
            // Close statement
            mysqli_stmt_close($stmt1);
        }
        else echo"failed";}
    if($flag1==0 and $flag2==0){
    if( $stmt = mysqli_prepare($link, $sql) and $stmt1=mysqli_prepare($link,$sql1) ){
        mysqli_stmt_bind_param($stmt, "ssiss", $item_id,$item_name,$price,$company,$origin);
        mysqli_stmt_bind_param($stmt1,"ssis",$item_id,$s_id,$qty,$item_name);
        if(mysqli_stmt_execute($stmt) and mysqli_stmt_execute($stmt1) ){ 

            echo"item is added successfully";
            header("location:s_dashboard.php");    
            } 
        else{
                echo "3Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmt1);
    }
    else echo"failed";}
    mysqli_close($link);
}
?>