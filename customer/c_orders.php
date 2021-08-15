<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="c_dashboard.css">
    <link rel="stylesheet" href="c_orders.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Client area</title>
    <style>
        .form{
            min-height: calc(100vh - 90px - 84px);
        }
    </style>
    <!--
    <script>
      // The function below will start the confirmation dialog
      function confirmDelivered() {
        let confirmAction = confirm("Is your order Delivered?");
        if (confirmAction) {
          alert("Thankyou For Ordering");
        } else {
          alert("Will be delivered soon.");
          break
        }
      }
      function confirmCancel(){
          let confirmAction=confirm("Are you sure you want to cancel order?")
          if(confirmAction){
              alert("We are requesting for order cancel.")
          }
          break
      }
    </script>
    -->
</head>
<div style="overflow-x:auto">
<body>
    <header>
        Hey, <?php  session_start(); echo $_SESSION["username"]; ?>!
        <nav>
          <a href="c_dashboard.php" >Home </a>
          <a href="c_orders.php">Orders</a>
          <a href="logout.php" >Logout</a>
        </nav>
    </header>

    <div class="form">
        <h2>Orders placed</h2>
        <?php 
        require_once "C:/xampp/htdocs/final/config.php";
        $sql="SELECT o.o_id ,i.item_name  ,i.price,i.company_name,i.origin,o.qty,s.name,s.s_id,i.item_id FROM orderplaced as o, item as i , shop as s WHERE o.c_id =?  and o.item_id=i.item_id and o.s_id=s.s_id";
        if($stmt = mysqli_prepare($link, $sql)){  // preparing query
            mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);
            if(mysqli_stmt_execute($stmt)){ 
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) >= 1){
                        mysqli_stmt_bind_result($stmt,$col1,$col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9);
                        ?>
                        <table style="margin-left:auto;margin-right:auto;">
                            <thead>
                                <tr>
                                    <th>Order_id</th>
                                    <th>Item_name</th>
                                    <th>Price</th>
                                    <th>Company_name</th>
                                    <th>Origin</th>
                                    <th>Qty</th>
                                    <th>Shopkeeper</th>
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
                                <form action="c_ordercancelled.php" method="POST">
                                <input type="hidden" name="o_id" value="<?php echo $col1; ?>" />
                                <input type="hidden" name="item_id" value="<?php echo $col9; ?>" />
                                <input type="hidden" name="qty" value="<?php echo $col6; ?>" />
                                <input type="hidden" name="s_id" value="<?php echo $col8; ?>" />
                                <td><button type="submit" onclick="confirmCancel()">Cancel</td>
                                </form>
                                <form action="c_ordersuccessed.php" method="POST">
                                <input type="hidden" name="o_id" value="<?php echo $col1; ?>" />
                                <input type="hidden" name="item_id" value="<?php echo $col9; ?>" />
                                <input type="hidden" name="qty" value="<?php echo $col6; ?>" />
                                <input type="hidden" name="s_id" value="<?php echo $col8; ?>" />
                                <td><button type="submit" onclick="confirmDelivered()" >Delivered</td>
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
    <div>
    <footer>Copyright © 2021-2022 OnlineFoodShop.
           All Rights are reserved</footer>
    </div>
</body>
</div>
</html>

