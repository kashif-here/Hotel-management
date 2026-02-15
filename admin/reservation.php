<?php
  require("../config.php");
  include("./includes/header.php");

  $sql = "SELECT r.reservation_id, r.no_adults, r.no_children, r.user_id, r.room_id,
                 u.user_email, u.user_fname, u.user_lname, u.user_phone,
                 rm.room_number, rm.room_name, rm.room_type, rm.check_in_date, rm.check_out_date
          FROM reservations r
          LEFT JOIN users u ON u.user_id = r.user_id
          LEFT JOIN rooms rm ON rm.room_id = r.room_id
          ORDER BY r.reservation_id DESC";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
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
  <table
    id="dtVerticalScrollExample"
    class="table table-striped table-bordered small"
    cellspacing="0"
  >
    <thead>
      <tr>
        <th class="th-sm">Reservation ID</th>
        <th class="th-sm">Guest</th>
        <th class="th-sm">Email</th>
        <th class="th-sm">Phone</th>
        <th class="th-sm">Room</th>
        <th class="th-sm">Type</th>
        <th class="th-sm">Adults</th>
        <th class="th-sm">Children</th>
        <th class="th-sm">Check in</th>
        <th class="th-sm">Check out</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!$rows) { ?>
        <tr>
          <td colspan="10" class="text-center">No reservations found.</td>
        </tr>
      <?php } else { ?>
        <?php foreach ($rows as $row) { ?>
          <tr>
            <td><?= $row["reservation_id"] ?></td>
            <td><?= trim($row["user_fname"]." ".$row["user_lname"]) ?></td>
            <td><?= $row["user_email"] ?></td>
            <td><?= $row["user_phone"] ?></td>
            <td><?= $row["room_number"]." - ".$row["room_name"] ?></td>
            <td><?= $row["room_type"] ?></td>
            <td class="text-center"><?= $row["no_adults"] ?></td>
            <td class="text-center"><?= $row["no_children"] ?></td>
            <td class="text-center"><?= is_null($row["check_in_date"]) ? "-" : $row["check_in_date"] ?></td>
            <td class="text-center"><?= is_null($row["check_out_date"]) ? "-" : $row["check_out_date"] ?></td>
          </tr>
        <?php } ?>
      <?php } ?>
    </tbody>
  </table>
</section>
<?php include("./includes/footer.php"); ?>
</body>
</html>

