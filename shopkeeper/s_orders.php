<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="s_dashboard.css">
    <link rel="stylesheet" href="C:/xampp/htdocs/final/customer/c_orders.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Client area</title>
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
          <button class="a"><a href="logout.php" >Logout</a></button> 
        </nav>
    </header>
    <div id ="main" class="form" >
        <h2 style="color: white;">Orders placed</h2>
        <?php 
        require_once "C:/xampp/htdocs/final/config.php";
        $sql="SELECT o.o_id ,i.item_name  ,i.price,i.company_name,i.origin,o.qty,c.name,c.c_id,i.item_id FROM orderplaced as o, item as i , customer as c WHERE o.s_id =?  and o.item_id=i.item_id and o.c_id=c.c_id";
        if($stmt = mysqli_prepare($link, $sql)){  // preparing query
            mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);
            if(mysqli_stmt_execute($stmt)){ 
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) >= 1){
                        mysqli_stmt_bind_result($stmt,$col1,$col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9);
                        ?>
                        <table style="margin-left:auto;margin-right:auto; color:white;">
                            <thead>
                                <tr>
                                    <th>Order_id</th>
                                    <th>Item_name</th>
                                    <th>Price</th>
                                    <th>Company_name</th>
                                    <th>Origin</th>
                                    <th>Qty</th>
                                    <th>Customer</th>
                                    <th>Cancel Order</th>
                                    <th>Order Delivered</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php while (mysqli_stmt_fetch($stmt)) {?>
                            <tr>
                                <td><?php echo "$col1"?></td>
                                <td><?php echo "$col2"?></td>
                                <td><?php echo "$col3"?></td>
                                <td><?php echo "$col4"?></td>
                                <td><?php echo "$col5"?></td>
                                <td><?php echo "$col6"?></td>
                                <td><?php echo "$col7"?></td>
                                <form action="s_ordercancelled.php" method="POST">
                                <input type="hidden" name="o_id" value="<?php echo $col1; ?>" />
                                <input type="hidden" name="item_id" value="<?php echo $col9; ?>" />
                                <input type="hidden" name="qty" value="<?php echo $col6; ?>" />
                                <input type="hidden" name="c_id" value="<?php echo $col8; ?>" />
                                <td><button type="submit">Cancel</td>
                                </form>
                                <form action="s_ordersuccessed.php" method="POST">
                                <input type="hidden" name="o_id" value="<?php echo $col1; ?>" />
                                <input type="hidden" name="item_id" value="<?php echo $col9; ?>" />
                                <input type="hidden" name="qty" value="<?php echo $col6; ?>" />
                                <input type="hidden" name="c_id" value="<?php echo $col8; ?>" />
                                <td><button type="submit">Delivered</td>
                                </form>
                            </tr>
                        <?php }
                        ?>
                            </tbody>
                        </table>
                       <?php }else{
                        echo "No order is placed";
                    }
                } 
            else{
                    echo "Oops! Something went wrong. Please try again later.";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
        else echo"failed";
         ?>
    </div>
</body>
<footer>Copyright © 2021-2022 OnlineFoodShop.
           All Rights are reserved</footer>
</html>
