<?php

@include 'connection.php';

session_start();

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
    <link rel="stylesheet" href="css/searchOID.css">

</head>
<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};

?>

<body>

<div class="container">

    <form action="" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search Order ID here..">
            <button type="submit" class="btn btn-primary" >Search</button>
        </div>
    </form>

    <h1>Order ID Details</h1>
    <div class="product-display">
        <table class="product-display-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
            </tr>
            </thead>
            <?php
            $con = mysqli_connect("localhost","root","","petshop");

            if(isset($_GET['search']))
            {
                $filtervalues = $_GET['search'];
                $query = "SELECT * FROM completed WHERE CONCAT(order_id) LIKE '$filtervalues' ";
                $query_run = mysqli_query($con, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $items)
                    {
                        ?>
                        <tr>
                            <td><?= $items['id']; ?></td>
                            <td><?= $items['order_id']; ?></td>

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