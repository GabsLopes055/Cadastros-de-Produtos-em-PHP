<?php

$pagina_anterior = $_SERVER['HTTP_REFERER'];

session_start();

if (isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Administrador') {
    header("Location: ../View/relatorios.php");
} else {
    header("Location: $pagina_anterior");
};