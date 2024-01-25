<!DOCTYPE html>
<html>
<head>
    <title>PDO - Read Records - PHP CRUD Tutorials</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- custome css -->
    <style>
        .m-r-1em{ margin-right:1em; }
        .m-b-1em{ margin-bottom:1em; }
        .m-l-1em{ margin-left:1em; }
        .mt0{ margin-top:0; }
    </style>
</head>    
<body>
    <!--container-->
    <div class="container">
        <div class="page-header">
            <h1>Read Products</h1>
        </div>   
        <!--PHP code to read records will be here-->
        <?php
        //include database connection
        include 'config/database.php';
        //delete message prompt will be here
        //select all data
        $query = "SELECT id, name, description, price FROM product ORDER BY id DESC";
        $stmt = $con->prepare($query);
        $stmt->execute();    
        //this is how to get number of rows returned
        $num = $stmt->rowCount();
        //link to create record form
        echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";
        //check if more than 0 record found
        if ($num>0) {
            //data from database will be here
            //start table
            echo"<table class='table-hover table-responsive table-bordered'>";
            //creating our table heading for table
            echo "<tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>Action</th>
                <tr>";
            //table body will be here
            //retieve out table contents
            //fetch() is faster than fetchAll()
            while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
                //extract row 
                //this will make $row['firstname'] to
                //just $firstname only
                extract($row);
                //creating new table row per record
                echo "<tr>
                        <td>{$id}</td>                      
                        <td>{$name}</td>
                        <td>{$description}</td>
                        <td>{$price}</td>
                    <td>";
                        //read one record
                        echo "<a href = 'read_one.php?id={$id}' class = 'btn btn-info m-r-1em'>Read</a>";
                        //we will use this link on next part of this post
                        echo "<a href = 'update.php?id={$id}' class = 'btn btn-primary m-r-1em'>Edit</a>";
                        //we will use this link on next part of this post
                        echo "<a href = '#' onclick = 'delete_user({$id});' class = 'btn btn-danger'>Delete</a>";
                    echo "</td>";
                echo "</tr>";
            }
            //end table
            echo "</table>";
                   
        }
            //if no records found
        else{
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>

    </div><!--end .container-->
    <!-- JQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- confirm delete record will be here -->
</body> 
</html>