<?php session_start(); ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    
    <nav class="navbar navbar-expand-sm p-3 text-bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand text-white" href="index.php">Bibliophilia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto menu">
            <li><a href="index.php"
                class="nav-link px-2 text-white menuLink">Home</a></li>
            
            <?php
                if (isset($_SESSION['username'])) {
                // User is signed in, show the Book Series link
                    echo '<li><a href="bookSeries.php" class="nav-link px-2 text-white menuLink">Book Series</a></li>';
                }
                else{
                    echo '<li><a class="nav-link px-2 text-danger menuLink">Book Series</a></li>';   
                }
            ?>

            <li><a href="contact.php"
                class="nav-link px-2 text-white menuLink">Contact</a></li>
            <li><a href="index.php#aboutUs"
                class="nav-link px-2 text-white menuLink">About Us</a></li>
            <?php
                if (isset($_SESSION['username'])) {
                // User is logged in, show the user profile icon
                echo '<li><a href="userProfile.php" class="nav-link px-2 text-white menuLink"><i class="fas fa-user"></i>My Profile</a></li>';
                }
            ?>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
            <input type="search"
                class="form-control form-control-dark text-bg-dark"
                placeholder="Search..." aria-label="Search">
            </form>

            <div class="actionButtons">
            <a href="login.php"><button type="button"
                class="btn btn-outline-light me-2">Login</button></a>
            <a href="signUp.php"><button type="button"
                class="btn btn-warning">Sign Up</button></a>
            </div>
        </div>
        </div>
    </nav>
   
    <?php
        // Connect to the database
        $con= mysqli_connect("localhost", "id20478439_admin","=wC?z\NhO_FJ^2Z7", "id20478439_bibliophilia");

        // Initialize variables
        $fname = $lname = $email = $mobile = $username = $password = "";
        $errors = array();

        // Check if the request method is a POST request
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate the data
            if (empty($_POST["fname"])) {
            $errors[] = "First name is required";
            } else {
            $fname = test_input($_POST["fname"]);
            }
            if (empty($_POST["lname"])) {
            $errors[] = "Last name is required";
            } else {
            $lname = test_input($_POST["lname"]);
            }
            if (empty($_POST["email"])) {
            $errors[] = "Email is required";
            } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
            }
            if (empty($_POST["mobile"])) {
            $errors[] = "Mobile number is required";
            } else {
            $mobile = test_input($_POST["mobile"]);
            }
            if (empty($_POST["username"])) {
            $errors[] = "Username is required";
            } else {
            $username = test_input($_POST["username"]);
            }
            if (empty($_POST["password"])) {
            $errors[] = "Password is required";
            } else {
            $password = test_input($_POST["password"]);
            }

            // Check if the username is already taken
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                $errors[] = "Username is taken!";
            }

            // If there are no errors, insert the data into the database
            if (empty($errors)) {
                $sql = "INSERT INTO users (firstName, lastName, email, mobile, username, password) VALUES ('$fname', '$lname', '$email', '$mobile', '$username', '$password')";
                if (mysqli_query($con, $sql)) {
                    header("Location: login.php");
                    exit;
                }
            }

        }
        // Function to sanitize data
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
    ?>
           
    <form  class="signUpContainer" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
        <h1>Sign Up</h1>
        <?php if (isset($errors) && in_array("Username is taken!", $errors)) { ?>
            <span style="color:red">Username is taken!</span>
        <?php } ?>

        <table>
            <tr>
                <td>First Name</td>
                <td>
                <input type="text" name="fname">
                <?php if (isset($errors) && in_array("First name is required", $errors)) { ?>
                    <span style="color:red">*Required</span>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                <input type="text" name="lname">
                <?php if (isset($errors) && in_array("Last name is required", $errors)) { ?>
                    <span style="color:red">*Required</span>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                <input type="text" name="email">
                <?php if (isset($errors) && in_array("Email is required", $errors)) { ?>
                    <span style="color:red">*Required</span>
                <?php } elseif (isset($errors) && in_array("Invalid email format", $errors)) { ?>
                    <span style="color:red">*Invalid</span>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td>
                <input type="text" name="mobile">
                <?php if (isset($errors) && in_array("Mobile number is required", $errors)) { ?>
                    <span style="color:red">*Required</span>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Username</td>
                <td>
                <input type="text" name="username">
                <?php if (isset($errors) && in_array("Username is required", $errors)) { ?>
                    <span style="color:red">*Required</span>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                <input type="password" name="password">
                <?php if (isset($errors) && in_array("Password is required", $errors)) { ?>
                    <span style="color:red">*Required</span>
                <?php } ?>
                </td>
            </tr>
        </table>


        <input type="submit" name="submit" value="Sign Up">
        <input type="reset">
    </form>

    <footer class="alert alert-secondary">
        <p class="text-center">&copy;2022&nbsp;&nbsp;Abbas Borji and Aya Kamar</p>
    </footer>

</body>
</html>