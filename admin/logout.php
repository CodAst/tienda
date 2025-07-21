<link rel="stylesheet" href="css/estilos.css">
<?php
session_start();
session_destroy();
header("Location: index.php?action=login");
exit();
