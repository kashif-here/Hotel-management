<?php
  require("../config.php");
  include("./includes/header.php");
?>
      <section class="content">
      <div class="text-danger">
      <?php
        if (isset($_SESSION["error"])) {
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
        }
        ?>
      </div>
      <div class="text-success">
      <?php
        if (isset($_SESSION["message"])) {
            echo $_SESSION["message"];
            unset($_SESSION["message"]);
        }
        ?>
      </div>
        <table
          id="dtVerticalScrollExample"
          class="table table-striped table-bordered small"
          cellspacing="0"
        >
          <thead>
            <tr>
              <th class="th-sm">Email</th>
              <th class="th-sm">First name</th>
              <th class="th-sm">Last names</th>
              <th class="th-sm">Verified</th>
              <th class="th-sm">DOB</th>
              <th class="th-sm">Phone</th>
              <th class="th-sm">Admin</th>
              <!-- <th class="th-sm">Address</th> -->
              <th class="th-sm">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM users";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                if ($row["user_verified"] == 1) {
                    $tableClass = "table-green";
                } else {
                    $tableClass = "table-red";
                } ?>
            <tr>
              <td><?= $row["user_email"] ?></td>
              <td><?= $row["user_fname"] ?></td>
              <td><?= $row["user_lname"] ?></td>
              <td><?= $row["user_verified"] == 1 ? "Yes" : "No" ?></td>
              <td><?= $row["user_dob"] ?></td>
              <td><?= $row["user_phone"] ?></td>
              <td class="<?= $row["user_admin"] ? "" : "text-center" ?>"><?= $row["user_admin"] == 1 ? "Admin" : "-" ?></td>
              <!-- <td><?= $row["address"] ?></td> -->
              <td>
                <a href="edit_user.php?user_id=<?= $row["user_id"]; ?>" class="text-success" title="Edit user">
                  <span class="fa fa-pencil"></span>
                </a>
                &nbsp;
                /
                &nbsp;
                <a href="delete_user.php?user_id=<?= $row["user_id"]; ?>" class="text-danger" title="Delete user">
                  <span class="fa fa-trash"></span>
                </a>
                &nbsp;
                /
                &nbsp;
                <?php if ($row["user_verified"] == 1) { ?>
                  <a href="toggle_user_verify.php?user_id=<?= $row["user_id"]; ?>" class="text-warning" title="Unverify user">
                    <span class="fa fa-times-circle"></span>
                  </a>
                <?php } else { ?>
                  <a href="toggle_user_verify.php?user_id=<?= $row["user_id"]; ?>" class="text-info" title="Verify user">
                    <span class="fa fa-check-circle"></span>
                  </a>
                <?php } ?>
              </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </section>

    <?php include("./includes/footer.php"); ?>
    
</body>
</html>
