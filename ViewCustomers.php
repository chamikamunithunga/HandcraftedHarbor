<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

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

<div class="container">


   <?php

   $select = mysqli_query($conn, "SELECT * FROM pets");
   
   ?>
    <h1>All Customer details</h1>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>User ID</th>
            <th>User name</th>
            <th>Email</th>
         </tr>
         </thead>
          <?php
          include_once "config.php";
          $sql="SELECT * from user_form where user_type='customer'";
          $result=$conn-> query($sql);
          $count=1;
          if ($result-> num_rows > 0){
              while ($row=$result-> fetch_assoc()) {

                  ?>
                  <tr>
                      <td><?=$count?></td>
                      <td><?=$row["name"]?>
                      <td><?=$row["email"]?></td>
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