<?php
session_start();
unset($_SESSION["user_id"]);
unset($_SESSION["username"]);
unset($_SESSION["status"]);

header("location: ../admin/auth.html");
?>