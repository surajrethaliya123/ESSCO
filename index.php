<?php
include 'config.php';
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!-- <?php if ($user_id): ?>
   <p>Welcome, user! You are logged in.</p>
<?php else: ?>
   <p>Welcome, guest! <a href="login.php">Login</a> to access more features.</p>
<?php endif; ?> -->

<?php
if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    // Ensure the user is logged in before adding to cart
    if ($user_id) {
        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Query failed');

        if (mysqli_num_rows($check_cart_numbers) > 0) { // Fix logic here
            $message[] = 'Already added to cart!';
        } else {
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Query failed');
            $message[] = 'Product added to cart!';
        }
    } else {
        $message[] = 'Please login to add items to the cart!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="shortcut icon" type="x-icon" href="images\cover.jpg">  
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ESSCO</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home" >
   

   <div class="content">
      <h3>ESSCO</h3>
      <p>Planning a bathroom is no more an afterthought.
            No matter how big or small the space is, everyone 
           desires an inviting bathroom. Today, Essco offers 
        complete bathroom solutions, covering a wide range
         of design options in bath fittings, sanitaryware,
          water heaters and bathroom accessories to give you
      inspiring bathrooms.
</p>
      <a href="shop.php" class="white-btn">discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about2.JPG" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>For over six decades Essco the bathroom brand has been the benchmark for the organised bath industry in India. Essco by Jaquar Group has demonstrated the value of true quality and trusted service for generations. The brand is built on the pillars of quality and affordability in designing and delivering products that are functional, promises great aesthetics at an easy–to-own price. As the brand rapidly expands its foot print in tier-II, III & IV cities across India, Essco has a total retail presence across 4000+ stores and the Jaquar Group aims increase the retail strength to 5000+ outlets by the year 2025.</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>We'd love to hear from you!Whether you have questions, feedback, or need assistance, our team is here to help. Please fill out the form or reach out to us via email or phone. 
         We aim to respond promptly to all inquiries.Thank you for connecting with us!</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>