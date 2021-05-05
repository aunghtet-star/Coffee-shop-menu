<?php
session_start();
ob_start();
include_once "admindashboard/header.php" ?>
    <?php
    include_once "connect.php";
    $db = mysqli_connect("127.0.0.1","root","","coffeeshop");
    $query = "SELECT * FROM today";
    $posts = mysqli_query($db,$query);
    ?>
    <div class="container">
        <div class="col">
            <br>

                <div class="card">

                        <div class="card-header">
                            <div class="card-title">Today Menu
                                <a href="to_create.php" class="btn btn-info btn-sm float-end">Add New</a>
                            </div>
                        </div>
                    <?php if (isset($_SESSION['successMsg'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php
                                echo $_SESSION['successMsg'];
                                unset($_SESSION['successMsg'])  ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-success">
                            <tr>
                                <th>No</th>
                                <th>Coffee</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($posts as $key=>$post){
                                ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $post['coffee'] ?></td>
                                    <td><?php echo $post['price'] ?> Ks</td>
                                    <td><a href="edit.php?postId=<?php echo $post['id']; ?>" class="btn-primary btn-sm btn">Edit</a>
                                        <a href="admindashboard.php?deleteId=<?php echo $post['id'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>

        </div>
    </div>
<?php
    if(isset($_GET['deleteId'])){
        $delete = $_GET['deleteId'];
        $db = mysqli_connect("127.0.0.1","root","","coffeeshop");
        $query = "DELETE FROM today WHERE id=$delete";
        $post =mysqli_query($db,$query);
        header('location:admindashboard.php');
        $_SESSION['successMsg'] = 'A post was successfully deleted';

    }
    ob_end_flush();
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
    </html>


<?php include_once "admindashboard/footer.php" ?>