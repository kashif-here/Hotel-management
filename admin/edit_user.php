<?php
  require("../config.php");
  ob_start();
  include("./includes/header.php");
?>
<section class="content admin-form">
  <h2 class="mb-3 mt-10 text-center">Edit User</h2>
  <div class="container">
    <div class="text-danger">
      <?php
        if (isset($_SESSION["error"])) {
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
        }
      ?>
    </div>
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

      if (isset($_POST["edit_user"])) {
          $user_email = trim($_POST["user_email"]);
          $user_fname = trim($_POST["user_fname"]);
          $user_lname = trim($_POST["user_lname"]);
          $user_dob = $_POST["user_dob"];
          $user_phone = trim($_POST["user_phone"]);
          $user_admin = $_POST["user_admin"] == "yes" ? 1 : 0;
          $user_verified = $_POST["user_verified"] == "yes" ? 1 : 0;

          $update = $pdo->prepare(
              "UPDATE users SET user_email = :user_email, user_fname = :user_fname, user_lname = :user_lname, user_dob = :user_dob, user_phone = :user_phone, user_admin = :user_admin, user_verified = :user_verified WHERE user_id = :user_id"
          );

          $update->execute(array(
              ":user_email" => $user_email,
              ":user_fname" => $user_fname,
              ":user_lname" => $user_lname,
              ":user_dob" => $user_dob,
              ":user_phone" => $user_phone,
              ":user_admin" => $user_admin,
              ":user_verified" => $user_verified,
              ":user_id" => $user_id,
          ));

          $_SESSION["message"] = "User updated successfully";
          header("Location: users.php");
          return;
      }
    ?>

    <form method="post">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-6">
          <div class="form-group">
            <label class="form-label" for="user_email">Email</label>
            <input type="email" name="user_email" id="user_email" class="form-control" value="<?= $row["user_email"]; ?>" required />
          </div>
          <div class="form-group">
            <label class="form-label" for="user_fname">First name</label>
            <input type="text" name="user_fname" id="user_fname" class="form-control" value="<?= $row["user_fname"]; ?>" required />
          </div>
          <div class="form-group">
            <label class="form-label" for="user_lname">Last name</label>
            <input type="text" name="user_lname" id="user_lname" class="form-control" value="<?= $row["user_lname"]; ?>" required />
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-6">
          <div class="form-group">
            <label class="form-label" for="user_dob">Date of birth</label>
            <input type="date" name="user_dob" id="user_dob" class="form-control" value="<?= $row["user_dob"]; ?>" required />
          </div>
          <div class="form-group">
            <label class="form-label" for="user_phone">Phone</label>
            <input type="text" name="user_phone" id="user_phone" class="form-control" value="<?= $row["user_phone"]; ?>" required />
          </div>
          <div class="form-group">
            <label class="form-label">Admin</label><br>
            <input type="radio" id="admin_yes" name="user_admin" value="yes" <?= $row["user_admin"] == 1 ? "checked" : "" ?> />
            <label for="admin_yes">Yes</label>
            <span>&nbsp;&nbsp;</span>
            <input type="radio" id="admin_no" name="user_admin" value="no" <?= $row["user_admin"] == 1 ? "" : "checked" ?> />
            <label for="admin_no">No</label>
          </div>
          <div class="form-group">
            <label class="form-label">Verified</label><br>
            <input type="radio" id="verified_yes" name="user_verified" value="yes" <?= $row["user_verified"] == 1 ? "checked" : "" ?> />
            <label for="verified_yes">Yes</label>
            <span>&nbsp;&nbsp;</span>
            <input type="radio" id="verified_no" name="user_verified" value="no" <?= $row["user_verified"] == 1 ? "" : "checked" ?> />
            <label for="verified_no">No</label>
          </div>
          <div class="form-group my-0.25">
            <button type="submit" name="edit_user" value="edit_user" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<?php include("./includes/footer.php"); ?>

<?php ob_end_flush(); ?>

</body>
</html>
