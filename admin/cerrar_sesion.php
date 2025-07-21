<?php
session_start();
session_destroy();
header("Location: login.php"); // o "../login.php" si está fuera de vista/
exit;
?>
