<?php

  require './dbConnection.php';

  $is_register_successful = false;

  if (isset($_POST['signup-button'])) {
    $first_name = $_POST['signup-first_name'];
    $last_name = $_POST['signup-last_name'];
    $username = $_POST['signup-username'];
    $email = $_POST['signup-email'];
    $password = $_POST['signup-password'];
    $confirm_password = $_POST['signup-confirm-password'];
    $region = $_POST['signup-region'];

    $check_username = "SELECT * FROM `pakh_pakhali`.`user_info` WHERE user_name = '$username'";
    $run_check_username = mysqli_query($connection, $check_username);
    $rows = mysqli_num_rows($run_check_username);

    try {
      if ($rows == 0) {
        if ($password == $confirm_password) {
          $password_hash = password_hash($password, PASSWORD_DEFAULT);
          $stmt = $connection->prepare("Insert into user_info(first_name, last_name, user_name, mail, password, region) values (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssss", $first_name, $last_name, $username, $email, $password_hash, $region);
          $stmt->execute();
          $stmt->close();

          $is_register_successful = true;
        } else {
          echo 'Password does not match! Try again.';
        }
      } else {
        echo 'Username already exists! Try a different one.';
      }
    } catch (Exception $e) {
      echo 'Something went wrong!';
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
    <?php require '../utilities/navigation_bar.php' ?>
    <?php
      if ($is_register_successful) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> You are now registered!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Registration not complete. Please try again.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      }
    ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>

