<?php
  require("../config.php");

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
  $statement = $pdo->prepare("SELECT user_verified, user_email FROM users WHERE user_id = :user_id");
  $statement->execute(array(":user_id" => $user_id));
  $row = $statement->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
      $_SESSION["error"] = "User not found";
      header("Location: users.php");
      return;
  }

  if (isset($_SESSION["user_email"]) && $_SESSION["user_email"] === $row["user_email"]) {
      $_SESSION["error"] = "You cannot change your own verification status";
      header("Location: users.php");
      return;
  }

  $new_value = $row["user_verified"] == 1 ? 0 : 1;
  $update = $pdo->prepare("UPDATE users SET user_verified = :user_verified WHERE user_id = :user_id");
  $update->execute(array(
      ":user_verified" => $new_value,
      ":user_id" => $user_id,
  ));

  $_SESSION["message"] = $new_value == 1 ? "User verified" : "User unverified";
  header("Location: users.php");
  return;
