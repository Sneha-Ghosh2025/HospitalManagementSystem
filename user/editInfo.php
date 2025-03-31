<?php
    include('method.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
</head>
<body>
<?php
    $reg_id = $_GET['reg_id'];

    $result = getInfo($reg_id);

    $row = $result->fetch_assoc();
?>

    <h1>EDIT USER INFO</h1>
    <form action="" method="post" enctype="multipart/form-data">

    <input type="hidden" name="reg_id" value="<?php echo $row['reg_id']?>">
    <p> Name</p>
    <p><input type="text" name="username" value="<?php echo $row['username']?>"></p>

    <p>Email-Id</p>
    <p><input type="email" name="email" value="<?php echo $row['email']?>"></p>

    <p>Contact No </p>
    <p><input type="number" name="contact" value="<?php echo $row['contact']?>"></p>

    <p><input type="submit" name="update" value="Upload"></p>
<?php
        if(isset($_POST['update']))
        {
            $res=updateUser($_POST);

            if($res==1)
            {
                echo "Data Updated";
                header("location:adminDisplay.php");
            }
        }
            else{
                echo "Data Not Updated";
            }    
    ?>

</form>
</body>
</html>