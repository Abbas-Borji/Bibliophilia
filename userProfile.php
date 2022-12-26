<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
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
                <li><a href="bookSeries.php" class="nav-link px-2 text-white menuLink">Book Series</a></li>
                <li><a href="contact.php" target="_blank"
                    class="nav-link px-2 text-white menuLink">Contact</a></li>
                <li><a href="index.php#aboutUs"
                    class="nav-link px-2 text-white menuLink">About Us</a></li>
                <li><a href="userProfile.php" class="nav-link px-2 text-secondary menuLink"><i class="fas fa-user"></i>My Profile</a></li>
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

    <form action="logout.php" method="post" style="margin:5% auto; width:80%;text-align:center;padding:1%;">
        <h1>Are you sure you want to sign out?</h1><br>
        <button type="submit" class="btn btn-warning">Sign Out</button>
    </form>

    <footer class="alert alert-secondary">
        <p class="text-center">&copy;2022&nbsp;&nbsp;Abbas Borji and Aya Kamar</p>
    </footer>

</body>
</html>