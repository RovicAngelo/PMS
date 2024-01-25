<!DOCTYPE html>
<html lang="en">
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and monified Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
        <?php
        if($_POST){
            // include database connection
            include 'config/database.php';
            try{
                // insert query
                $query = "INSERT INTO product SET name=:name, description=:description, price=:price, created=:created";
                // prepare quiry for execution
                $stmt = $con->prepare($query);
                // posted values
                $name=htmlspecialchars(strip_tags($_POST['name']));
                $description=htmlspecialchars(strip_tags($_POST['description']));
                $price=htmlspecialchars(strip_tags($_POST['price']));

                //bind the parameter
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                //specify when this record was inserted to the database
                $created=date('Y-m-d H:i:s');
                $stmt->bindParam(':created', $created);
                //Execute the query
                if($stmt->execute()){
                    echo"<div class='alert alert-success'>Record was saved.</div>";
                }else{
                    echo"<div class='alert alert-danger'>Unable to save record.</div>";
                }
            }
            //show the error
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>
        <!-- html form to create product will be here -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <table class='table table-hover table-responsive table-border'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control' ></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="text" name='price' class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value='save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read product</a>
                    </td>
                </tr>   
            </table>
        </form>
    </div>
    <!-- end .container -->

    <!-- jQuery (necessary for Bootstrap product will be here) -->
    <script src="./js/bootstrap.min.js"></script>
</body>
</html>