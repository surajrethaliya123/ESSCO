<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

  <!-- <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="https://www.instagram.com/_betweenart_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="fab fa-instagram"></a>
         </div>
         <p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div> !-->

   <div class="header-2">
      <div class="flex">
      <img src="images/logo.png" alt="">
         <a href= "index.php" class="logo">TOOLS AND HARDWARE </a>

         <nav class="navbar">
            <a href="index.php">home</a>
            <a href="about.php">about</a>
            <a href="shop.php">shop</a>
            <a href="contact.php">contact</a>
            <a href="orders.php">orders</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
   <?php if(isset($_SESSION['user_id'])): ?> 
      <p>Username: <span><?php echo $_SESSION['user_name']; ?></span></p>
      <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
      <a href="logout.php" class="delete-btn">Logout</a>
   <?php else: ?>
      <p>Welcome, Guest!</p>
      <a href="login.php" class="btn">Login</a>
      <a href="register.php" class="btn">Register</a>
   <?php endif; ?>
</div>


</header>
