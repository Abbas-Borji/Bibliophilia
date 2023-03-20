<?php session_start();ob_start(); ?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Series</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
    crossorigin="anonymous">
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
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
            <li><a href="bookSeries.php" class="nav-link px-2 text-secondary menuLink">Book Series</a></li>
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
    $con= mysqli_connect("localhost", "id20478439_admin","=wC?z\NhO_FJ^2Z7", "id20478439_bibliophilia");
    $sql = "SELECT BID, title,author,description,img, reserved FROM books";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container my-3'>";

        $counter = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($counter % 4 == 0) {
                echo "<div class='row'>";
            }
            echo "<div class='col-lg-3 my-3'>";
            echo "<div class='card'>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($row['img']) . "' class='card-img-top' alt='" . $row['title'] . "'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row['title'] . "</h5>";
            echo "<p class='card-text'>" . $row['author'] . "</p>";
            
            
            echo "<form method='post' action='reserve.php'>";
            echo "<input type='hidden' name='BID' value='" . $row['BID'] . "'>";
            echo "<div class='buttonGroup'>";
            echo "<div><button type='button' data-bs-toggle='modal' data-bs-target='#exampleModal' class='button1 btn btn-primary' onclick='showDescription(\"" . $row['description'] . "\", \"" . $row['title'] . "\")'>View Description</button></div>";
            echo "<div>";
            if ($row['reserved']) {
                echo "<button type='submit' class='btn btn-secondary' disabled>Reserved</button>";
            } else {
                echo "<button type='submit' class='btn btn-success'>Reserve</button>";
            }
            echo "</div></div></div></form></div></div>";
            $counter++;
            if ($counter % 4 == 0) {
                echo "</div>";
            }
        }
        if ($counter % 4 != 0) {
            echo "</div>";
        }
        echo "</div>";
    }
    mysqli_close($con);
  ?>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <footer class="alert alert-secondary">
    <p class="text-center">&copy;2022&nbsp;&nbsp;Abbas Borji and Aya Kamar</p>
  </footer>

  <script>
    function showDescription(description,title) {
      const modalBody = document.querySelector('.modal-body');
      modalBody.innerText = description;
      const modalTitle = document.querySelector('.modal-title');
      modalTitle.innerText = title;
    }
  </script>

</body>

</html>