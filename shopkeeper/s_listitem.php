<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="s_dashboard.css">
    <link rel="stylesheet" href="C:/xampp/htdocs/final/customer/c_orders.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        nav{
        padding-left: 400px;
      }
      nav a{ 
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 26px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
    }
    #main{
        min-height:calc(100vh - 155px) ;
    }
    </style>
</head>
<body>
<header>
        <nav>
          Hey, <?php  session_start(); echo $_SESSION["username"]; ?>!
          &ensp;
          <button class="a"><a href="s_dashboard.php" >Home </a></button>
          <button class="a"><a href="s_orders.php">Orders</a></button> 
          <button class="a"><a href="s_listitem.php">ITEMS</a></button>
          <button class="a"><a href="s_additem.html">Add New Items</a></button>
          <button class="a"><a href="C:/xampp/htdocs/final/logout.php" >Logout</a></button> 
        </nav>
    </header>  
<div id="main">   
<?php
require_once "config.php";
if(1){
    $sql='select item_id,s_id,qty from available where s_id=?';
    if($stmt= mysqli_prepare($link, $sql) ){
        mysqli_stmt_bind_param($stmt, "s",$_SESSION["username"]);
        if(mysqli_stmt_execute($stmt) ){ 
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) >= 1){
            mysqli_stmt_bind_result($stmt,$col1,$col2,$col3);
            ?>
            
            <table style="margin-left:auto;margin-right:auto;">
                <thead>
                    <tr>
                    <th>item_name</th>
                    <th>Price</th>
                    <th>Company_name</th>
                    <th>Qty</th>
                    <th>Enter Qty</th>
                    <th>Update</th>
                    <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
            <?php while (mysqli_stmt_fetch($stmt)) {
                    $sql1="select i.item_name,i.price,i.company_name from shop as s ,item as i where s.s_id=? and i.item_id=?";
                    if($stmt1=mysqli_prepare($link,$sql1))
                    {
                        mysqli_stmt_bind_param($stmt1, "ss", $col2,$col1);
                        if(mysqli_stmt_execute($stmt1))
                        {
                            mysqli_stmt_store_result($stmt1);
                            if(mysqli_stmt_num_rows($stmt1) == 1)
                            {
                                mysqli_stmt_bind_result($stmt1,$col4,$col5,$col6);
                                while (mysqli_stmt_fetch($stmt1)) {?>
                            <tr>
                                <td><?php echo "$col4"?></td>
                                <td><?php echo "$col5"?></td>
                                <td><?php echo "$col6"?></td>
                                <td><?php echo "$col3"?></td>
                                <form action="s_incrqty.php" method="POST">
                                <input type="hidden" name="item_id" value="<?php echo $col1; ?>" />
                                <td><input type="number" name="qty"  placeholder="qty"/></td>
                                <input type="hidden" name="s_id" value="<?php echo $col2; ?>" />
                                <td><button type="submit">Update</td>
                                </form>
                                <form action="s_removeitem.php" method="POST">
                                <input type="hidden" name="item_id" value="<?php echo $col1; ?>" />
                                <input type="hidden" name="s_id" value="<?php echo $col2; ?>" />
                                <td><button type="submit">Remove</td>
                                </form>
                            </tr>
            </div>
                            <?php }}
                            else echo"no result";
                        }
                        else echo"something wrong";
                        mysqli_stmt_close($stmt1);
                    }
                    else echo "failed1";
            }?>
            </tbody>
            </table>
            <?php } 
            else echo"Searched item is not available";
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
</div>  
<footer>Copyright © 2021-2022 OnlineFoodShop.
           All Rights are reserved</footer>
 
</body>

</html>
