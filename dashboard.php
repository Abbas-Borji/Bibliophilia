<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">  
</head>
<body>
    
    <!-- Add A Book -->
    <div class="dashboardContainer">
        <h1>Add A Book</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <table class="dashboardContainertableExpand">
                <tr><th>Title</th><td><input type="text" name="title" ></td></tr>
                <tr><th>Author</th><td><input type="text" name="author" ></td></tr>
                <tr><th>Quantity</th><td><input type="number" name="quantity" ></td></tr>
                <tr><th>Price</th><td><input type="number" name="price" ></td></tr>
                <tr><th>Description</th><td><textarea name="description"></textarea></td></tr>
                <tr><th>Image</th><td><input type="file" name="img" ></td></tr>
                <tr><th>Reserved</th><td><input type="checkbox" name="reserved" value="1"></td></tr>
                <tr><th><input type="submit" name="submit" value="Add New Product"></th><td></td></tr>
            </table>
        </form>
        <?php
            error_reporting(0);
            if (isset($_POST["submit"])) {
                $con = mysqli_connect("localhost", "root","", "library");
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_FILES['img']) && !empty($_FILES['img']['tmp_name'])) {
                        $title = test_input($_POST["title"]);
                        $author = test_input($_POST["author"]);
                        $quantity = test_input($_POST["quantity"]);
                        $price = test_input($_POST["price"]);
                        $description = test_input($_POST["description"]);
                        $img = file_get_contents($_FILES['img']['tmp_name']);
                        $reserved = isset($_POST["reserved"]) ? 1 : 0;
                        $sql = "INSERT INTO books (title, author, quantity, price, description, img, reserved) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        $stmt1 = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt1, "ssisssi", $title, $author, $quantity, $price, $description, $img, $reserved);
                        if (mysqli_stmt_execute($stmt1)) {
                            header("Location:dashboard.php");
                        } else {
                            echo "Error: " . mysqli_error($con);
                        }
                        mysqli_close($con);
                    }
                }
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
    </div><br><br><br>

    <!-- Update A Book -->
    <div class="dashboardContainer">
            <h1>Update A Book</h1>
            <?php
            $con= mysqli_connect("localhost", "root","", "library");
            if (isset($_POST["save"])) {
                // Retrieve the values of the form fields
                $id = $_POST["id"];
                $title = $_POST["title"];
                $author = $_POST["author"];
                $quantity = $_POST["quantity"];
                $price = $_POST["price"];
                $description = $_POST["description"];
                $reserved = $_POST["reserved"];
            
                // Check if a file was selected
                if (!empty($_FILES['img']['name'])) {
                    // Retrieve the uploaded image file
                    $image_file = $_FILES['img'];
                    $image_data = file_get_contents($image_file['tmp_name']);
                }
            
                // Create the UPDATE statement
                $update_query = "UPDATE books SET title = ?, author = ?, quantity = ?, price = ?, description = ?, img = ?, reserved = ? WHERE BID = ?";
            
                // Prepare the UPDATE statement for execution
                
                $stmtS = mysqli_prepare($con, $update_query);        //OPENED
            
                // Bind the values to the prepared statement
                mysqli_stmt_bind_param($stmtS, "ssiisssi", $title, $author, $quantity, $price, $description, $image_data, $reserved, $id);
            
                // Execute the prepared statement
                if (mysqli_stmt_execute($stmtS)) {
                // Display a success message
                echo "<h1>Record updated successfully</h1>"; 
                } else {
                echo "Error updating record: " . mysqli_error($con);
                }
            
                // Close the prepared statement
                mysqli_stmt_close($stmtS);
                header("location:dashboard.php"); 
                
            }

            if(isset($_GET['did'])){
                $id=$_GET['did'];
                // Use a prepared statement to delete a book
                $stmt = mysqli_prepare($con, "DELETE FROM books WHERE BID=?");
                // Bind the parameter to the prepared statement
                mysqli_stmt_bind_param($stmt, "i", $id);
                // Execute the prepared statement
                if (mysqli_stmt_execute($stmt))
                    echo "Record deleted successfully";
                else
                    echo "Error deleting record: " . mysqli_error($con);
                // Close the prepared statement
                mysqli_stmt_close($stmt);
            }

            // Use a prepared statement to retrieve all the rows from the books table
                $stmt = mysqli_prepare($con, "SELECT * from books");                    
                // Execute the prepared statement
                mysqli_stmt_execute($stmt);
                // Bind the result to a variable
                mysqli_stmt_bind_result($stmt, $BID, $title, $author, $quantity, $price, $description, $img, $reserved);                                            
                $editing = -1;          

            
                            

            if (isset($_POST["edit"])) {
                $editing = $_POST["id"];
            }

            echo "<table><tr><th>Book</th><th>Title</th><th>Author</th><th>Quantity</th><th>Price</th><th>Description</th><th>Image</th><th>Reservation</th><th>Update</th><th>Delete</th></tr>";

            // Fetch the results of the prepared statement
            while (mysqli_stmt_fetch($stmt)) {
                echo "<tr>";

                if ($editing == $BID) {
                    echo "<form method='post' enctype='multipart/form-data'>";
                    echo "<td><input type='text' name='id' value='" . $BID . "'></td>";
                    echo "<td><input type='text' name='title' value='" . $title . "'></td>";
                    echo "<td><input type='text' name='author' value='" . $author . "'></td>";
                    echo "<td><input type='text' name='quantity' value='" . $quantity . "'></td>";
                    echo "<td><input type='text' name='price' value='" . $price . "'></td>";
                    echo "<td><input type='text' name='description' value='" . $description . "'></td>";
                    echo "<td><input type='file' name='img' accept='image/png'></td>";
                    echo "<td><input type='text' name='reserved' value='" . $reserved . "'></td>";
                    echo "<td><input type='submit' name='save' value='save'></td>";
                    echo "</form>";
                } else {
                    // Retrieve the image data
                    $image_data_base64 = base64_encode($img);
                    $image_src = "data:image/png;base64," . $image_data_base64;
                    echo "<td>" . $BID . "</td>";
                    echo "<td>" . $title . "</td>";
                    echo "<td>" . $author . "</td>";
                    echo "<td>" . $quantity . "</td>";
                    echo "<td>" . $price . "</td>";
                    echo "<td>" . $description . "</td>";
                    echo "<td><img src='" . $image_src . "' style='width:50px;' alt='" . $title . "'></td>";
                    echo "<td>" . $reserved . "</td>";
                    echo "<td><form method='post'><input type='hidden' name='id' value='" . $BID . "'><input type='submit' name='edit' value='edit'></form></td>";
                    echo "<td><a href='dashboard.php?did=" . $BID . "'>delete</a></td>";
                }

                echo "</tr>";
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);

            echo "</table>";

            
            
            // Close the database connection
            mysqli_close($con);
    
            ?>
    </div><br><br><br>

    <!-- Add A User -->
    <div class="dashboardContainer">
        <h1 style="background-color:lightblue;">Add A User</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <table class="dashboardContainertableExpand">
                <tr><th>First Name</th><td><input type="text" name="firstName" ></td></tr>
                <tr><th>Last Name</th><td><input type="text" name="lastName" ></td></tr>
                <tr><th>Email</th><td><input type="text" name="email" ></td></tr>
                <tr><th>Mobile</th><td><input type="number" name="mobile" ></td></tr>
                <tr><th>Username</th><td><input type="text" name="username" ></td></tr>
                <tr><th>Password</th><td><input type="password" name="password"></td></tr>
                <tr><th><input type="submit" name="addUser" value="Add New User"></th><td></td></tr>
            </table>
        </form>
        <?php
            if (isset($_POST["addUser"])) {
                $con = mysqli_connect("localhost", "root","", "library");
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $firstName = test_input($_POST["firstName"]);
                    $lastName = test_input($_POST["lastName"]);
                    $email = test_input($_POST["email"]);
                    $mobile = test_input($_POST["mobile"]);
                    $username = test_input($_POST["username"]);
                    $password = test_input($_POST["password"]);
                    $sql = "INSERT INTO users (firstName, lastName, email, mobile, username, password) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt2 = mysqli_prepare($con, $sql);
                    mysqli_stmt_bind_param($stmt2, "ssssss", $firstName, $lastName, $email, $mobile, $username, $password);
                    if (mysqli_stmt_execute($stmt2)) {
                        header("Location:dashboard.php");
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                    mysqli_close($con);
                    
                }
            }
        ?>
    </div><br><br><br>
    
</body>
</html>