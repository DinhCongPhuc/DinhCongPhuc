<?php
session_start();
session_unset();
session_destroy();
header("Location: Trangchu.php"); // Chuyển hướng về trang chủ
exit();
?>
