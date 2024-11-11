<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
sleep(1);
exit();
