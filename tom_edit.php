
<?php
session_start();

include_once "admindashboard/header.php" ?>
<?php
include_once "connect.php";

 if (isset($_GET['id'])){
     $idUpdate = $_GET['id'];
     $db = mysqli_connect("127.0.0.1","root","","coffeeshop");
     $query = "SELECT * FROM coffee_table WHERE id=$idUpdate";
     $results = mysqli_query($db,$query);

         foreach ($results as $result){
             $id = $result['id'];
            $name = $result['coffee'];
            $price =  $result['price'];

     }
 }

$nameError = '';
$priceError = '';

if (isset($_POST['button'])){
    $id = $_POST['id'];
    $name =$_POST['name'];
    $price =$_POST['price'];

    if(empty($name)){
        $nameError = "The name field is required";
    }
    if(empty($price)){
        $priceError = "The price field is required";
    }
    if (!empty($name) && !empty($price)){
        $db = mysqli_connect("127.0.0.1","root","","coffeeshop");
        $query="UPDATE coffee_table SET coffee='$name', price=$price WHERE id=$id";
        $post = mysqli_query($db,$query);
        header('location:tomorrowmenu.php');
        $_SESSION['successMsg']= 'A post was succesfully updated';

    }


}

?>
<div class="container">
    <div class="col">
        <div class="row">
            <div class="card">
                <div class="row">
                    <div class="card-header">
                        <div class="card-title">Create Page
                            <a href="admindashboard.php" class="btn btn-info btn-sm float-end">Back</a>
                        </div>
                    </div>

                </div>
                <form action="tom_edit.php" method="post">
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="hidden" name="id" value="<?php echo $id ?> ">
                            <label for="">Name</label>
                            <input type="text" name="name" value="<?php echo $name ?>"
                                   class="form-control <?php if($nameError != ''):?> is-invalid <?php endif; ?>"
                                   placeholder="coffee">
                            <span class="text-danger"><?php echo $nameError ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="">Price</label>
                            <input type="text" name="price" class="form-control <?php if($priceError != ''):?> is-invalid <?php endif; ?>" value="<?php echo $price ?>" placeholder="price">
                            <span class="text-danger"><?php echo $priceError ?></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="button" class="btn btn-primary ">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?php include_once "admindashboard/footer.php"?>
