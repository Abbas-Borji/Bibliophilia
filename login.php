<?php session_start();ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

            <li><a href="contact.php" target="_blank"
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
                
        if (isset($_POST['submit'])) {

            if($_POST['submit'] == "Sign Up") {
                header("Location:signUp.php");
                exit;
            }
            elseif($_POST['submit'] == "Submit" && !isset($_SESSION['username'])) {
                $con= mysqli_connect("localhost", "id20478439_admin","=wC?z\NhO_FJ^2Z7", "id20478439_bibliophilia");

                $username = mysqli_real_escape_string($con, $_POST['username']);
                $password = mysqli_real_escape_string($con, $_POST['password']);

                $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) == 1) {
                    // User is in the database
                    $_SESSION['username'] = $username;
                    header("Location: bookSeries.php");
                    exit;
                } else {
                    // User is not in the database
                    echo '<script type="text/javascript">';
                    echo 'window.alert("Wrong Credentials!");';
                    echo '</script>';
                }
            }
            else{
                // Already logged in
                echo '<script type="text/javascript">';
                echo 'window.alert("You are already logged in!");';
                echo '</script>';
            } 
        }
    ?>
    
    <div class="signUpContainer">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
        <h1>Sign In</h1>    
        <table>
            <tr><td>Username</td><td><input type="text" name="username"></td></tr>
            <tr><td>Password</td><td><input type="password" name="password"></td></tr>
        </table>

        <button id="loginButton" type="submit" name="submit" value="Submit">Login</button>
        </form>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <button id="loginSignUpLink" type="submit" name="submit" value="Sign Up">Sign Up</button>
        </form>
    </div>



    <footer class="alert alert-secondary">
        <p class="text-center">&copy;2022&nbsp;&nbsp;Abbas Borji and Aya Kamar</p>
    </footer>

</body>
</html>