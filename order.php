<?php

@include 'config.php';
$conn = mysqli_connect("localhost","root","","petshop");
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `order` WHERE id = $delete_id ") or die('query failed');
    if($delete_query){
        header('location:order.php');
        $message[] = 'product has been deleted';
    }else{
        header('location:admin.php');
        $message[] = 'product could not be deleted';
    };
};

if(isset($_GET['done'])){
    $done_id = $_GET['done'];
    $insert_query = mysqli_query($conn, "INSERT INTO `completed` (order_id) VALUES ('$done_id')") or die('query failed');
    if($insert_query){
        header('location:order.php');
    }else{
        header('location:order.php');
    };
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style5.css">

</head>
<body>

<header class="header">

    <div class="header-1">

        <a href="" class="logo">PET PALACE</a>
        <nav class="navbar">
            <a href="admin.php">Add Pets</a>
            <a href="additems.php"">Add Items</a>
            <a href="ViewCustomers.php">View Customers</a>
            <a href="order.php"">Orders</a>
            <a href="completedOrders.php"">Delivered</a>
        </nav>

        <div class="icons">
            <a href="logout.php" class="fa-solid fa-right-from-bracket"></a>
        </div>

    </div>



</header>


<div class="container">

    <section class="display-product-table">

        <table>

            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Payment method</th>
            <th>Flat</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Pin Code</th>
            <th>Total Products</th>
            <th>Total Price</th>
            <th>Action</th>
            </thead>

            <tbody>
            <?php

            $select_products = mysqli_query($conn, "SELECT * FROM `order`");
            if(mysqli_num_rows($select_products) > 0){
                while($row = mysqli_fetch_assoc($select_products)){
                    ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['number']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['method']; ?></td>
                        <td><?php echo $row['flat']; ?></td>
                        <td><?php echo $row['street']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['state']; ?></td>
                        <td><?php echo $row['country']; ?></td>
                        <td><?php echo $row['pin_code']; ?></td>
                        <td><?php echo $row['total_products']; ?></td>
                        <td>Rs-<?php echo $row['total_price']; ?>/-</td>
                        <td> <a href="order.php?delete=<?php echo $row['id']; ?>" class="delete-btn" > <i class="fas fa-trash"></i> </a>
                            <a href="order.php?done=<?php echo $row['id']; ?>" class="done-btn"> <i class="fa-solid fa-truck"></i>  </a>
                        </td>
                    </tr>

                    <?php
                };
            }else{
                echo "<div class='empty'>No Orders Yet</div>";
            };
            ?>
            </tbody>
        </table>

    </section>


</div>

<!-- custom js file link  -->
<script src="js/script2.js"></script>

</body>
</html>