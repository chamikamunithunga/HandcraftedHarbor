<?php
@include 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />


    <!------- swipper cdn link ------------>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<header class="header">

    <div class="header-1">

        <a href="" class="logo">PET PALACE</i></a>
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
<?php


@include 'searchOID.php'

?>

<div class="container">

    <div class="product-display">
        <table class="product-display-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>

            </tr>
            </thead>
            <?php
            include_once "config.php";
            $sql="SELECT * from completed";
            $result=$conn-> query($sql);
            $count=1;
            if ($result-> num_rows > 0){
                while ($row=$result-> fetch_assoc()) {

                    ?>
                    <tr>
                        <td><?=$row["id"]?></td>
                        <td><?=$row["order_id"]?></td>
                    </tr>
                    <?php
                    $count=$count+1;

                }
            }
            ?>
        </table>
    </div>

</div>


</body>
</html>