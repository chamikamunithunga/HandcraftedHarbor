<?php

@include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:index.php');
};

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:index.php');
};


if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `carts` WHERE name = '$product_name'AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($select_cart) > 0){
        $message[] = 'product already added to cart';
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO `carts`(user_id, name, price, image, quantity) VALUES('$user_id','$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'product added to cart succesfully';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style4.css">
</head>
<body>
<header class="header">

    <div class="header-1">
        <a href="" class="logo">PET PALACE</a>

        <nav class="navbar">
            <a href="home.html">Home</a>
            <a href="home.html"">About</a>
            <a href="home.html">Services</a>
            <a href="items.php">Items</a>
            <a href="pets.php">Pets</a>
        </nav>

        <?php

        $select_rows = mysqli_query($conn, "SELECT * FROM `carts`  WHERE user_id = '$user_id'") or die('query failed');
        $row_count = mysqli_num_rows($select_rows);

        ?>


        <div class="icons">
            <a href="search.php" class="fas fa-search"></a>
            <a href="cart.php" class="fas fa-shopping-cart"> <span><?php echo $row_count; ?></span> </a>
            <a href="logout.php" class="fa-solid fa-right-from-bracket"></a>

        </div>

    </div>



</header>


<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};

?>



<div class="container">

    <section class="products">

        <h1 class="heading">Pet Items</h1>

        <div class="box-container">

            <?php

            $select_products = mysqli_query($conn, "SELECT * FROM `items`");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
                    ?>

                    <form action="" method="post">
                        <div class="box">
                            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
                            <h3><?php echo $fetch_product['name']; ?></h3>
                            <div class="price">Rs-<?php echo $fetch_product['price']; ?>/-</div>
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
                        </div>
                    </form>

                    <?php
                };
            };
            ?>

        </div>

    </section>

</div>

<!-- custom js file link  -->
<script src="js/script2.js"></script>

</body>
</html>