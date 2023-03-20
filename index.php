<?php session_start();ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
                class="nav-link px-2 text-secondary menuLink">Home</a></li>
            
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

    <div class="container-fluid homeBanner">
        <img src="images/homeBanner.png" class="homeBanner" alt="Home Banner">
        <div class="image-text"><p>Explore The World of Knowledge at Your Fingertips</p></div>
    </div>

    <div class="aboutUs container p-5" id="aboutUs">
        <h2>About Us</h2>
        <p>
            Welcome to the Bibliophilia Library! We are a public library located in 
            Beirut,Lebanon and have been serving our community for many years. Our mission is to 
            provide access to a wide range of knowledge and information, and to support 
            lifelong learning for all members providing high-quality 
            resources and services.
            <br><br>
            Our library is more than just a place to borrow books. We offer a variety of 
            services and resources, including electronic databases, e-books and 
            audiobooks, and access to online learning platforms. We also host events and
            programs for all ages, including book clubs, workshops, and educational 
            presentations.
            <br><br>
            Our collection includes a very large quantity of books and magazines.
            We have a special collection of local history materials,
            as well as a large children's and young adult section. Our staff is always 
            available to help you find the materials you need, or to suggest new books 
            and resources that might be of interest.
            <br><br>
            The Bibliophilia Library is open Monday through Friday from 9am to 9pm, and
            Saturdays from 9am to 5pm. We offer a number of services outside of these 
            hours, including 24/7 access to our online resources and a convenient book 
            drop for returning materials. We also have a spacious, well-lit parking lot
            for your convenience.
            <br><br>
            As a vital resource for our community, our library is dedicated to providing 
            access to knowledge, and learning. From our collections of 
            books and other materials, to our programs and events, we are committed to 
            serving the needs of our patrons. We are grateful for the support of our 
            community and look forward to continuing to be a place of discovery and 
            learning for all.
            <br><br>
            We hope to see you at the library soon or virtually through our online 
            resources!
        </p>
    </div>

    <footer class="alert alert-secondary">
        <p class="text-center">&copy;2022&nbsp;&nbsp;Abbas Borji and Aya Kamar</p>
    </footer>

</body>
</html>