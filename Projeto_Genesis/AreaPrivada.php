<?php
    session_start();
    if(!isse($_SESSION['ID_USUARIO']))
    {
        header("location: index.php")
        exit;
    }
?>

SEJA BEM VINDO!