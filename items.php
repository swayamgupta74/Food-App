<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="customer/c_dashboard.css">
    <link rel="stylesheet" href="customer/c_orders.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        main{
            min-height: calc(100vh - 52px - 100px);
        }
        nav{
        padding-left: 1000px;
      }
    </style>
</head>
<body>
<header>
        
        <nav>
          <button><a href="dashboard.html" >Home</a></button>
          <button><a href="login.html">Login</a></button>
        </nav>
    </header>  
<main>   
<?php
require_once "config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $str=$_POST["search"];
    $sql='select item_id,s_id,qty from available where type=?';
    if($stmt= mysqli_prepare($link, $sql) ){
        mysqli_stmt_bind_param($stmt, "s",$str);
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
                    <th>Shopkeeper</th>
                    <th>Qty</th>
                    <th>Enter Qty</th>
                    <th>Place Order</th>
                    </tr>
                </thead>
                <tbody>
            <?php while (mysqli_stmt_fetch($stmt)) {
                    $sql1="select i.item_name,i.price,i.company_name,s.name from shop as s ,item as i where s.s_id=? and i.item_id=?";
                    if($stmt1=mysqli_prepare($link,$sql1))
                    {
                        mysqli_stmt_bind_param($stmt1, "ss", $col2,$col1);
                        if(mysqli_stmt_execute($stmt1))
                        {
                            mysqli_stmt_store_result($stmt1);
                            if(mysqli_stmt_num_rows($stmt1) == 1)
                            {
                                mysqli_stmt_bind_result($stmt1,$col4,$col5,$col6,$col7);
                                while (mysqli_stmt_fetch($stmt1)) {?>
                            <tr>
                                <td><?php echo "$col4"?></td>
                                <td><?php echo "$col5"?></td>
                                <td><?php echo "$col6"?></td>
                                <td><?php echo "$col7"?></td>
                                <td><?php echo "$col3"?></td>
                                <?php if($col3>0){ ?>
                                <form action="login.html" method="POST">
                                <input type="hidden" name="item_id" value="<?php echo $col1; ?>" />
                                <td><input type="number" name="qty" min="1" max=<?php echo $col3?> value="1" placeholder="qty"/></td>
                                <td><button type="submit">Place</td>
                                </form>
                                <?php } else{?>
                                <td>0</td>
                                <td>sorry</td>
                                <?php } ?>
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
</main>   
<footer>Copyright © 2021-2022 OnlineFoodShop.
           All Rights are reserved</footer>
</body>

</html>
