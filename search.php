<?php

@include 'connection.php';

session_start();
$user_id = $_SESSION['user_id'];
if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $quantity = 1; // Set the initial quantity to 1
    $conn = mysqli_connect("localhost","root","","books");

    $check_query = "SELECT * FROM `carts` WHERE name = '$product_name' AND user_id = '$user_id'" or die('query failed');
    $check_result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($check_result) > 0){
        $message[] = 'product already added to cart';
    } else {

        $insert_query = "INSERT INTO `carts` (name, price, image, quantity, user_id) VALUES ('$product_name', '$product_price', '$product_image', '$quantity', '$user_id')";
        $insert_result = mysqli_query($conn, $insert_query);
        $message[] = 'product added to cart successfully';
        
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />


    <!------- swipper cdn link ------------>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/search.css">

</head>
<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};

?>

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
        $conn = mysqli_connect("localhost","root","","books");
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

<div class="container">

    <form action="" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search items">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>

    <h1>All Customer details</h1>
    <div class="product-display">
        <table class="product-display-table">
            <thead>
            <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Preview</th>
                            <th>Action</th>
            </tr>
            </thead>
                                    <?php
                                    $con = mysqli_connect("localhost","root","","petshop");

                        if(isset($_GET['search']))
                        {
                        $filtervalues = $_GET['search'];
                        $query = "SELECT * FROM items WHERE CONCAT(name) LIKE '%$filtervalues%' ";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                        foreach($query_run as $items)
                        {


                        ?>

                        <tr>
                            <td><?= $items['id']; ?></td>
                            <td><?= $items['name']; ?></td>
                            <td>Rs-<?= $items['price']; ?>/-</td>
                            <td><img class="product_img" src="uploaded_img/<?php echo $items['image']; ?>" alt=""></td>
                            <td><form action="" method="post">
                                    <input type="hidden" name="product_id" value="<?= $items['id']; ?>">
                                    <input type="hidden" name="product_name" value="<?= $items['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?= $items['price']; ?>">
                                    <input type="hidden" name="product_image" value="<?= $items['image']; ?>">
                                    <button type="submit" name="add_to_cart" class="add">Add to cart</button>
                                </form></td>
                        </tr>
<?php
                        }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="4">No Record Found</td>
                            </tr>
                            <?php
                        }
                        }
                                    ?>
        </table>

    </div>

</div>

</body>
</html>