<?php
session_start();
unset($_SESSION["listadoSeries"]);
session_destroy();

header("Location: index.php");


?>