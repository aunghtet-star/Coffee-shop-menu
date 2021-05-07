
<?php
session_start();

include_once "../admindashboard/header.php" ?>

<?php

if (isset($_GET['id'])){
    $edit = $_GET['id'];
    $db = mysqli_connect("127.0.0.1", "root", "", "coffeeshop");
    $query="SELECT * FROM login_register WHERE id=$edit ";
    $result= mysqli_query($db,$query);
    $ary = mysqli_fetch_assoc($result);
}
    if(isset($_POST['r-btn'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $c_password = $_POST['c-password'];
        if (empty($name)) {
            $nameError = "The name field is empty";
        }
        if (strlen($name) <=10 ) {
            if(!preg_match('/(?=.*[a-z])(?=.*[A-Z])/', $name)){
                $nameneed= "username is at least 1 small and Capital character";
            };
         }else{
            $nameneed = "user name is not match , at most 10 characters";
        }
        if (empty($email)) {
            $emailError = "The email field is empty";
        }
        if (empty($password)) {
            $passwordError = "The password field is empty";
        }
        if (empty($c_password)) {
            $c_Error = "The confirm-password field is empty";
        }
        if ($password != $c_password) {
            $n_password = "Password is not equal";
        }
        if (strlen($password) >= 6) {
            $needPassword = preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|\w))/', $password);
            if ($needPassword == true) {

                if (!empty($name) && !empty($email) && !empty($password) && !empty($c_password)
                    && ($password == $c_password) && strlen($password) >= 6) {
                    $db = mysqli_connect("127.0.0.1", "root", "", "coffeeshop");
                    $query = "UPDATE login_register SET name='$name',email='$email',password='$password',
                                role='$role' WHERE id=$id";

                    $post = mysqli_query($db, $query);
                    $_SESSION['successMsg']='A post was successfully updated';
                    header('location:userDashboard.php');
                }
            }else {
               $needPass = "Password is need at least small letter and Capital letter and 3 digits and special characters";
            }
        } else {
            $passError = "The password is at least 6 characters";
        }



    }
?>
<div class="container">
    <div class="col">
        <div class="card mt-3 mb-3">
            <div class="card-header bg-success">
                <div class="card-title">User edit Form</div>
            </div>
            <form action="user_edit.php" method="post">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $ary['id']?>">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" value="<?php  echo $ary['name']; ?>"
                               class="form-control <?php if (!empty($nameError) || ($nameneed == true)): ?> is-invalid <?php endif; ?>" placeholder="Username">
                        <span class="text-danger"><?php
                            if ($nameError){
                                echo $nameError ;
                            }elseif ($nameneed){
                                echo $nameneed;
                            }
                            ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" value="<?php echo $ary['email'] ?>"
                               class="form-control <?php if (!empty($emailError)): ?> is-invalid <?php endif; ?>" placeholder="Email">
                        <span class="text-danger"><?php echo $emailError ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="text" name="password" value="<?php echo $ary['password'] ?>"
                               class="form-control <?php if (!empty($passwordError) || $passError == true || $needPass ==true ): ?> is-invalid <?php endif; ?>" placeholder="Password">
                        <span class="text-danger"><?php
                            if ($passwordError){
                                echo $passwordError;
                            }elseif($passError){
                                echo $passError;
                            }elseif($needPass){
                                echo $needPass;
                            }
                            ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="">Role</label>
                        <select name="role" class="form-select" id="">
                            <option value="">Select Role</option>
                            <option value="admin" <?php if ($ary['role'] == 'admin'): ?> selected <?php endif; ?>>Admin</option>
                            <option value="user" <?php if ($ary['role'] == 'user'): ?> selected<?php endif; ?>>User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">confirm-Password</label>
                        <input type="password" name="c-password" class="form-control <?php if (!empty($c_Error) || $n_password == true): ?> is-invalid <?php endif; ?>" placeholder="confirm-Password">
                        <span class="text-danger"><?php
                            if ($c_Error){
                                echo $c_Error;
                            }elseif ($n_password){
                                echo $n_password;
                            }

                            ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="r-btn" class="btn btn-sm btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once "admindashboard/footer.php"?>

