<header class="header">

   <div class="flex">

      <a href="#" class="logo">PET PALACE</a>

      <nav class="navbar">
         <a href="ViewCustomers.php">View Customers</a>
          <a href="order.php">View Orders</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `carts`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>
   </div>

</header>