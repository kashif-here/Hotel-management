<?php
if (!isLoggedIn()) {
  header("Location: ".SROOT."/login.php");
  exit;
}

if (!isAdmin($pdo)) {
  $_SESSION["error"] = "Access denied.";
  header("Location: ".SROOT."/index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap css -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />

    <!-- Jquery UI theme -->
    <link
      rel="stylesheet"
      href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"
    />

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <!-- Custom css -->
    <?php $cssVersion = defined("ROOT") ? filemtime(ROOT.DS."css".DS."main.css") : filemtime(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."css".DIRECTORY_SEPARATOR."main.css"); ?>
    <link rel="stylesheet" href="<?php echo SROOT."/css/main.css?v=".$cssVersion; ?>" />

    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />

    <link href="<?php echo SROOT."/vendor/fullcalender/main.min.css"; ?>" rel="stylesheet" />

    <title>Hotel management</title>
  </head>
  <body class="admin">
<header id="admin-header">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo SROOT."/admin/index.php"; ?>"><img src="<?php echo SROOT."/media/images/logo/Cloud_Nine_Hotel-removebg.png";?>" class="d-inline-block align-top" height="90px"></img></a>
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div
        class="collapse navbar-collapse bg-dark w-100"
        id="navbarSupportedContent"
    >
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="<?php echo SROOT."/index.php"; ?>" class="nav-link">Back to website</a>
        </li>
        <li class="nav-item dropdown">
            <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            >
            Account
            </a>
            <div
            class="dropdown-menu dropdown-menu-right"
            aria-labelledby="navbarDropdown"
            >
            <?php if (isLoggedIn()) { ?>
            <span class="dropdown-item">
              Signed in as <b><?= $_SESSION["user_fname"]." ".$_SESSION["user_lname"]; ?></b>
            </span>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo SROOT."/admin/index.php"; ?>">Admin Panel</a>
            <a class="dropdown-item" href="<?php echo SROOT."/accounts.php"; ?>">Account</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo SROOT."/core/logout_user.php"; ?>">Logout</a>
            <?php } else { ?>
            <a class="dropdown-item" href="<?php echo SROOT."/login.php"; ?>">Log in</a>
            <a class="dropdown-item" href="<?php echo SROOT."/signup.php"; ?>">Sign up</a>
            <?php } ?>
            </div>
        </li>
        </ul>
        <ul class="navbar-nav side-nav bg-dark text-light">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo SROOT."/admin/rooms.php"; ?>">Rooms</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo SROOT."/admin/add_room.php"; ?>">Add new Room</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo SROOT."/admin/reservation.php"; ?>">Reservations</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="./users.php">Users</a>
        </li>
        </ul>
    </div>
    </nav>
</header>
<main id="admin-main">