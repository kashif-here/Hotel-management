<?php
  require("../config.php");
  ob_start();
?>

<?php include("./includes/header.php"); ?>
<section class="content">
    <?php
      if (isset($_GET["user_id"])) {
          if (is_null($_GET["user_id"]) || $_GET["user_id"] === "") {
              $_SESSION["error"] = "User id cannot be empty";
              header("Location: users.php");
              return;
          }
      } else {
          $_SESSION["error"] = "Invalid user id";
          header("Location: users.php");
          return;
      }

      $user_id = $_GET["user_id"];
      $statement = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
      $statement->execute(array(":user_id" => $user_id));
      $row = $statement->fetch(PDO::FETCH_ASSOC);

      if (!$row) {
          $_SESSION["error"] = "User not found";
          header("Location: users.php");
          return;
      }

      if (isset($_SESSION["user_email"]) && $_SESSION["user_email"] === $row["user_email"]) {
          $_SESSION["error"] = "You cannot delete your own account";
          header("Location: users.php");
          return;
      }
    ?>
    <h2 class="text-center">Are you sure?</h2>
    <table class="table table-bordered text-center">
      <thead>
        <tr>
          <th scope="col">Fields</th>
          <th scope="col">Details</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>User I.D.</td>
          <td><?= $row["user_id"] ?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><?= $row["user_email"] ?></td>
        </tr>
        <tr>
          <td>Name</td>
          <td><?= $row["user_fname"] . " " . $row["user_lname"] ?></td>
        </tr>
        <tr>
          <td>Verified</td>
          <td><?= $row["user_verified"] == 1 ? "Yes" : "No" ?></td>
        </tr>
        <tr>
          <td>Admin</td>
          <td><?= $row["user_admin"] == 1 ? "Yes" : "No" ?></td>
        </tr>
      </tbody>
    </table>
    <br>
    <form method="POST">
      <div class="row" style="margin-left: 15%;">
        <div class="col">
          <button class="btn btn-primary" name="cancel" style="margin-left: 15%;">Cancel</button>
        </div>
        <div class="col">
          <button class="btn btn-danger" name="submit">Submit</button>
        </div>
      </div>
    </form>

<?php
      if (isset($_POST["submit"])) {
          $delete = $pdo->prepare("DELETE FROM users WHERE user_id = :user_id LIMIT 1");
          $delete->execute(array(":user_id" => $user_id));
          $_SESSION["message"] = "User deleted successfully";
          header("Location: users.php");
          die();
      }
      if (isset($_POST["cancel"])) {
          header("Location: users.php");
      }
      ob_end_flush();
?>

</section>
</body>
</html>
