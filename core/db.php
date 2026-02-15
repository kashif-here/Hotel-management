<?php

    try {
        $pdo =  new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        session_start();
        $pdo->exec(
            "UPDATE rooms SET room_booked = 0 WHERE room_booked = 1 AND check_out_date IS NOT NULL AND check_out_date < CURDATE()"
        );
    } catch (PDOException $err) {
        die($err->getMessage());
    }
