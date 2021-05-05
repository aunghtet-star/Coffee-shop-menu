<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
    <!--Boostrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="col">
            <div class="row">
                <h1 class="text-center">Brista Khine Coffeshop</h1>
            </div>
            <div class="row text-center">
                <h4>Today Available Menu</h4>
            </div>
            <div class="col-md-6 offset-md-3">

                <table class="table table-bordered table-hover text-center">
                    <thead class="bg-success">
                    <tr>
                        <th>No</th>
                        <th>Coffee</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $db = mysqli_connect("127.0.0.1", "root", "", "coffeeshop");
                    $query = "SELECT * FROM today";
                    $posts = mysqli_query($db, $query);
                    foreach ($posts as $key=>$post){
                    ?>
                    <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $post['coffee'] ?></td>
                        <td><?php echo $post['price'] ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <hr>


            </div>
            <div class="row text-center"><h4>Next Day Menu</h4></div>
            <div class="col-md-6 offset-md-3">
                <table class="table table-bordered table-hover text-center">
                    <thead class="bg-success">
                    <tr>
                        <th>No</th>
                        <th>Coffee</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php

                        $db = mysqli_connect("127.0.0.1", "root", "", "coffeeshop");
                        $query = "SELECT * FROM coffee_table";
                        $posts = mysqli_query($db, $query);

                        foreach ($posts as $key=>$post){
                        ?>
                    <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $post['coffee'] ?></td>
                        <td><?php echo $post['price'] ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tr>
                    </tbody>
                </table>

            </div>
            <hr>
            <div class="row text-center">
                <h3>About us</h3>
                <p class="fw-lighter">We are good reviews in Pyin Oo Lwin Township.So You can take My clean foodies.</p>
            </div>
            <div class="row ">
                <h3 class="text-center">Contact us</h3>
            </div>
            <div class="col-md-6 offset-md-3">
                <ul>
                    <li>Phone   - 09989384939</li>
                    <li>Address - Shwebo st,Pyin Oo Lwin TownShip</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer text-center" style="background: black ; color:white; padding:25px 0 ; margin: 0" >
        <p>Copyright &copy; by Aung Htet.All rights reserved.</p>
    </div>

<!--Bootstrap Js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>