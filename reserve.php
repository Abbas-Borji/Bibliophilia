<?php
  // Connect to the database
  $con= mysqli_connect("localhost", "root","", "library");

  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the book id from the form
    $BID = mysqli_real_escape_string($con, $_POST['BID']);

    // Update the database to mark the book as reserved
    $sql = "UPDATE books SET reserved=1 WHERE BID=$BID";
    if (mysqli_query($con, $sql)) {
      // Redirect to the same page to update the display
      header("Location: bookSeries.php");
      exit;
    } else {
      echo "Error updating record: " . mysqli_error($con);
    }
  }
  mysqli_close($con);
?>
