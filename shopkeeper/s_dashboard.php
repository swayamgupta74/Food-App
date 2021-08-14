<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="s_dashboard.css">
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
          <button class="a"><a href="#" >Home </a></button>
          <button class="a"><a href="s_orders.php">Orders</a></button> 
          <button class="a"><a href="s_listitem.php">ITEMS</a></button>
          <button class="a"><a href="s_additem.html">Add New Items</a></button>
          <button class="a"><a href="logout.php" >Logout</a></button> 
        </nav>
    </header>

    <main class="main1">
      <form action="s_items.php" , method="post">
      <input type="text" name="search" placeholder="search for item" required>
      <button type="submit" name="button">search</button>
      </form>
    </main>
    
    <div class="images">
      <h3 style="color: black;">OUR IMAGE GALLARY</h3>
      <img src="https://images.theconversation.com/files/180401/original/file-20170731-22175-67v3q2.jpg?ixlib=rb-1.1.0&rect=0%2C589%2C5472%2C2654&q=45&auto=format&w=1356&h=668&fit=crop" alt="Burger">
      <img src="https://www.englishclub.com/images/vocabulary/food/italian/italian-food-1024.jpg" alt="Noodles">
      <img src="https://s3-ap-southeast-1.amazonaws.com/s3fileslive/public/gallery/40825_food_pizza_1477172.jpeg" alt="Pizza">
      <img src="https://images.pexels.com/photos/291528/pexels-photo-291528.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="pastry">
      <br><br>
      <img src="https://images.pexels.com/photos/1262302/pexels-photo-1262302.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="icecream">
      <img src="https://images.pexels.com/photos/1435735/pexels-photo-1435735.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Fruits">
      <img src="https://i.pinimg.com/originals/ec/cd/ac/eccdaca5183c7570f355a5c2da0896a0.jpg" alt="Drinks">
      <img src="https://th.bing.com/th/id/OIP.3dXCXht_0q0STvJebHfnGwHaHa?w=200&h=200&c=7&o=5&dpr=1.5&pid=1.7" alt="Yellow lays">
      <br><br>
      <img src="https://th.bing.com/th/id/OIP.sCluX_ie7cop8868isy2VgHaJ4?pid=ImgDet&rs=1" alt="Blue Lays">
      <img src="https://n3.sdlcdn.com/imgs/c/u/t/Lays-Potato-Chips-ASCO-250-SDL326304136-1-6f8a3.jpg" alt="American Lays">
      <img src="https://images-na.ssl-images-amazon.com/images/I/71v5gc8DAYL._SL1500_.jpg" alt="orange lays">
      <img src="https://www.bigbasket.com/media/uploads/p/l/40003269_3-lays-potato-chips-chile-limon.jpg" alt="chilly lemon">
    </div>
    <footer>Copyright © 2021-2022 OnlineFoodShop.
           All Rights are reserved</footer>
</body>

</html>
