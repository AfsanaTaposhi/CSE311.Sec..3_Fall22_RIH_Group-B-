<?php
  require './dbConnection.php';
  session_start();
  if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("location: ../login_signup.php");
    exit;
  }

  $owner = $_SESSION['username'];
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
    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php include '../utilities/navbar_when_loggedin.php' ?>;

    <div class="container my-4">
      <table class="table" id="bird_table">
        <thead>
        <tr>
          <th scope="col">Ring id</th>
          <th scope="col">Species Name</th>
          <th scope="col">Mutation</th>
          <th scope="col">Date of Birth</th>
          <th scope="col">Breed Pair</th>
          <th scope="col">Able to breed</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
          $sql = "SELECT * FROM `pakh_pakhali`.`bird` WHERE owner = '$owner'";
          $result = mysqli_query($connection, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>" . $row['ring_id'] . "</td>
            <td>" . $row['species_name'] . "</td>
            <td>" . $row['mutation'] . "</td>
            <td>" . $row['birth_date'] . "</td>
            <td>" . $row['breed_pair'] . "</td>
            <td>" . $row['is_breed_able'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=" . 'edit' . $row['owner'] . '__' . $row['ring_id'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=" . 'delete' . $row['owner'] . '__' . $row['ring_id'] . ">Delete</button>  </td>
          </tr>";
          }
        ?>
        </tbody>
      </table>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
         aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="./add_bird_data.php" method="post" id="add_bird_data" name="add_bird_data">
              <div class="mb-3">
                <label for="ring_number_edit" class="form-label">Ring id</label>
                <input type="text" class="form-control mb-3" id="ring_number_edit" name="ring_number_edit"
                       aria-describedby="ring_number"
                       maxlength="50" required>
                <label for="species_name_edit" class="form-label">Species Name</label>
                <input type="text" class="form-control mb-3" id="species_name_edit" name="species_name_edit"
                       aria-describedby="species_name_edit"
                       maxlength="50" required>
                <label for="mutation_edit" class="form-label">Mutation</label>
                <input type="text" class="form-control mb-3" id="mutation_edit" name="mutation_edit"
                       aria-describedby="mutation_edit"
                       maxlength="100" required>
                <label for="birth_date_edit" class="form-label">Date of Birth</label>
                <input type="date" class="form-control mb-3" id="birth_date_edit" name="birth_date_edit"
                       aria-describedby="birth_date_edit"
                       required>
                <label for="breed_pair_edit" class="form-label">Breed Pair</label>
                <input type="number" class="form-control mb-3" id="breed_pair_edit" name="breed_pair_edit"
                       aria-describedby="birth_date">
                <label for="is_breed_able_edit" class="form-label">Able to Breed?</label>
                <select class="form-select mb-5" id="is_breed_able_edit" name="is_breed_able"
                        aria-label="is_breed_able_edit"
                        required>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                <button type="submit" class="btn btn-primary" id="add_bird_data_btn" name="add_bird_data_btn">Submit
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#bird_table').DataTable();
      });
    </script>
    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("edit ");
          const tr = e.target.parentNode.parentNode;
          const rind_id = tr.getElementsByTagName("td")[0].innerText;
          const species_name = tr.getElementsByTagName("td")[1].innerText;
          const mutation = tr.getElementsByTagName("td")[2].innerText;
          const birth_date = tr.getElementsByTagName("td")[3].innerText;
          const breed_pair = tr.getElementsByTagName("td")[4].innerText;
          const is_breed_able = tr.getElementsByTagName("td")[5].innerText;


          ring_number_edit.value = rind_id;
          species_name_edit.value = species_name;
          mutation_edit.value = mutation; 
          birth_date_edit.value = birth_date;
          breed_pair.value = breed_pair;
          is_breed_able.value = is_breed_able;


          console.log(e.target.id)
          $('#editModal').modal('toggle');
        })
      })
    </script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>