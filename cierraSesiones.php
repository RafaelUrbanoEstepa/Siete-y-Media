<?php
session_start();
unset($_SESSION["baraja"]);
session_destroy();

header("Location: index.php");


?>