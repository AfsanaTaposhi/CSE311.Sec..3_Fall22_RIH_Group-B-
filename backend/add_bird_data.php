<?php
  require "./dbConnection.php";
  session_start();

  if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("location: ../login_signup.php");
    exit;
  } else {
    $add_bird_data_successful = false;

    if (isset($_POST['add_bird_data_btn'])) {
      $owner = $_SESSION['username'];
      $ring_number = $_POST['ring_number'];
      $species_name = $_POST['species_name'];
      $mutation = $_POST['mutation'];
      $birth_date = $_POST['birth_date'];
      $breed_pair = $_POST['breed_pair'];
      $is_breed_able = $_POST['is_breed_able'];

      $check_ring_number = "SELECT * FROM `pakh_pakhali`.bird WHERE owner = '$owner' AND ring_id = '$ring_number'";
      $run_check_ring_number = mysqli_query($connection, $check_ring_number);
      $rows = mysqli_num_rows($run_check_ring_number);

      try {
        if ($rows == 0) {
          if ($breed_pair == '' || strlen($breed_pair) == 0)
            $breed_pair = NULL;
          $stmt = $connection->prepare("INSERT INTO `pakh_pakhali`.`bird`(`owner`, `ring_id`, `species_name`, `mutation`, `birth_date`, `breed_pair`, `is_breed_able`) VALUES (?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("sssssii", $owner, $ring_number, $species_name, $mutation, $birth_date, $breed_pair, $is_breed_able);
          $stmt->execute();
          $stmt->close();

          $add_bird_data_successful = true;
        } else {
          echo 'Use different ring id!';
        }
      } catch (Exception $e) {
        echo 'Something went wrong!';
      }
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

    <title>Hello, world!</title>
  </head>
  <body>
    <?php include '../utilities/navbar_when_loggedin.php' ?>;

    <div class="container">
      <form action="./add_bird_data.php" method="post" id="add_bird_data" name="add_bird_data">
        <div class="mb-3">
          <label for="ring_number" class="form-label">Ring id</label>
          <input type="text" class="form-control mb-3" id="ring_number" name="ring_number"
                 aria-describedby="ring_number"
                 maxlength="50" required>
          <label for="species_name" class="form-label">Species Name</label>
          <input type="text" class="form-control mb-3" id="species_name" name="species_name"
                 aria-describedby="species_name"
                 maxlength="50" required>
          <label for="mutation" class="form-label">Mutation</label>
          <input type="text" class="form-control mb-3" id="mutation" name="mutation" aria-describedby="mutation"
                 maxlength="100" required>
          <label for="birth_date" class="form-label">Date of Birth</label>
          <input type="date" class="form-control mb-3" id="birth_date" name="birth_date" aria-describedby="birth_date"
                 required>
          <label for="breed_pair" class="form-label">Breed Pair</label>
          <input type="number" class="form-control mb-3" id="breed_pair" name="breed_pair"
                 aria-describedby="birth_date">
          <label for="is_breed_able" class="form-label">Able to Breed?</label>
          <select class="form-select mb-5" id="is_breed_able" name="is_breed_able" aria-label="is_breed_able" required>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
          <button type="submit" class="btn btn-primary" id="add_bird_data_btn" name="add_bird_data_btn">Submit</button>
      </form>
    </div>

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
