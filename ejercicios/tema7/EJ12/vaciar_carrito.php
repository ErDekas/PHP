<?php
session_start();
unset($_SESSION["productosEnCesta"]);
header("Location: index.php");
exit();
