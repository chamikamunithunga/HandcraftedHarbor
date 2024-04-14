<?php
@include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:index.php');
    exit();
}

if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    $select_product = mysqli_query($conn, "SELECT * FROM `pets` WHERE id = '$product_id'");
    $fetch_product = mysqli_fetch_assoc($select_product);

    if(!$fetch_product){
        header('location: items.php');
        exit();
    }
} else {
    header('location: items.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Product Details</title>
    <!-- Add your CSS stylesheets or include the existing ones -->
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
            <a href="searchpet.php" class="fas fa-search"></a>
            <a href="cart.php" class="fas fa-shopping-cart"> <span><?php echo $row_count; ?></span> </a>
            <a href="logout.php" class="fa-solid fa-right-from-bracket"></a>

        </div>

    </div>



</header>

<section class="join section">
    <div class="join__container container grid">
        <div class="join__data">
            <h2 class="section__title">
                <?php echo $fetch_product['name']; ?>
            </h2>
        <div class="details">

            <p>Price: Rs- <?php echo $fetch_product['price']; ?>/-</p>
            <p>Gender: <?php echo $fetch_product['gender']; ?></p>
            <p>Description: <?php echo $fetch_product['description']; ?></p>

        </div>
            <form action="" class="back">
                <button class="back__button">
                    <a href="items.php">Back to Items</a>
                </button>
            </form>
        </div>
        <div class="join__image">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="join image" class="join__img">
            <div class="join__shadow"></div>
        </div>
    </div>
</section>

</body>
</html>
