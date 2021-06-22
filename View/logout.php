<?php
session_start();
unset($_SESSION['sessaoUsuario']);
header("Location: ../View/login.php");
?>