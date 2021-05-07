<?php
session_start();
ob_start();
if (!($_SESSION['SuccessMsg'])){
    header('location:index.php');
}
if (!($_SESSION['role'] == 'admin')){
    header('location:index.php');
}
include_once "../admindashboard/header.php" ?>
<?php
include_once "connect.php";
$db = mysqli_connect("127.0.0.1","root","","coffeeshop");
$query="SELECT * FROM login_register";
$posts = mysqli_query($db,$query);
?>
    <div class="container">
        <div class="col">
            <div class="row">
                <div class="card">
                    <div class="row">
                        <div class="card-header">
                            <div class="card-title">User Dashboard
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <?php if ($_SESSION['successMsg']): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php
                                    echo $_SESSION['successMsg'];
                                    unset($_SESSION['successMsg']);  ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <table class="table table-bordered table-hover">
                            <thead class="bg-success">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($posts as $key=>$post){
                                ?>
                                <tr>
                                    <td><?php echo $post['id'] ?></td>
                                    <td><?php echo $post['name'] ?></td>
                                    <td><?php echo $post['email'] ?></td>
                                    <td><?php echo $post['password'] ?></td>
                                    <td><?php echo $post['role'] ?></td>
                                    <td><a href="/user/user_edit.php?id=<?php echo $post['id'] ?>" class="btn-primary btn-sm btn">Edit</a>
                                        <a href="userDashboard.php?deleteId=<?php echo $post['id'] ?>"
                                           class="btn btn-danger btn-sm" onclick="return confirm('are you sure?');">Delete</a>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<?php
if (isset($_GET['deleteId'])){
    $delete = $_GET['deleteId'];
    $db = mysqli_connect("127.0.0.1","root","","coffeeshop");
    $query= "DELETE FROM login_register WHERE id=$delete";
    mysqli_query($db,$query);
    header("location:userDashboard.php");
    $_SESSION['successMsg'] = 'A post was successfully deleted';


}
ob_end_flush();
?>

    </body>
    </html>