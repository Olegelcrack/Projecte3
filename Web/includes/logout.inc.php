<?php

    session_start();    // continuem la sessio inciada
    session_unset();    // trenquem la sessio
    session_destroy();

    header("location: ../index.php"); //ens retorna a l'arxiu inicial
    exit();
?>