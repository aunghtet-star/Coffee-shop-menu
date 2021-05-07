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
    if (isset($_POST['loginbtn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $db = mysqli_connect("127.0.0.1", "root", "", "coffeeshop");
        $query = "SELECT * FROM login_register WHERE email='$email' AND password='$password'  ";
        $result =mysqli_query($db,$query);
        $ary = mysqli_fetch_assoc($result);
        $row = mysqli_num_rows($result);

        if ($row === 1){
            header('location:/index.php');
            $aryName = preg_replace("/[[:alpha:]]{3}$/",".",$ary['name']);
            $_SESSION['SuccessMsg'] = $aryName;
            $_SESSION['role'] =$ary['role'];
            if (!($_SESSION['role'] == 'admin')){
                header('location:/index.php');
            }else{
                header('location:/admindashboard.php');
            }

        }else{
            $error = "The email or password is incorrect!";
        }



    }
?>
<div class="row h-nav">
    <div class="col">
        <h5>Coffee Shop</h5>
    </div>
    <div class="col">
        <a href="/loginregisteration/register.php" class="btn btn-success btn-sm float-end ">Register</a>
    </div>
</div>
<div class="container">
    <div class="col">
        <div class="card mt-3 mb-3">
            <div class="card-header bg-success">
                <div class="card-title">Login</div>
            </div>
            <form action="login.php" method="post">
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php
                                 echo  $error
                                ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="loginbtn" class="btn btn-primary btn-sm">Login</button>
                    <span>if you already register <a href="register.php">,Register</a> here</span>
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