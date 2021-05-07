<?php
session_start();
?>
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
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<?php
    if(isset($_POST['r-btn'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
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
                    $query = "INSERT INTO login_register(name,email,password) 
                  VALUES ('$name','$email','$password')";
                    $post = mysqli_query($db, $query);
                    header('location:login.php');
                }
            }else {
               $needPass = "Password is need at least small letter and Capital letter and 3 digits and special characters";
            }
        } else {
            $passError = "The password is at least 6 characters";
        }



    }
?>
<div class="row h-nav">
    <div class="col">
        <h5>Coffee Shop</h5>
    </div>
    <div class="col">
        <a href="/loginregisteration/login.php" class="btn btn-success btn-sm float-end ">Sign in</a>
    </div>
</div>
    <div class="container">
        <div class="col">
            <div class="card mt-3 mb-3">
                <div class="card-header bg-success">
                    <div class="card-title">Register</div>
                </div>
                <form action="" method="post">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" value="<?php echo $name ?>"
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
                        <input type="email" name="email" value="<?php echo $email ?>"
                               class="form-control <?php if (!empty($emailError)): ?> is-invalid <?php endif; ?>" placeholder="Email">
                        <span class="text-danger"><?php echo $emailError ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" value="<?php echo $password ?>"
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
                    <button type="submit" name="r-btn" class="btn btn-sm btn-primary">Register</button>
                    <span>if you already register <a href="login.php">,login</a> here</span>
                </div>
                </form>
            </div>
        </div>
    </div>



<div class="footer text-center" style="background: black ; color:white; padding:25px 0 ; margin: 0" >
    <p>Copyright &copy; by Aung Htet.All rights reserved.</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>