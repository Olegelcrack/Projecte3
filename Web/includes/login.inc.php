<?php

    if(isset($_POST["inicia-sessio"])){     // si s'ha enviat el formulari

        $usuari = $_POST["usuari"]; // gravem els camps per fer la coprovacio
        $contrasenya = $_POST["contrasenya"];

        require_once 'Con_DB.inc.php'; //cridem la connexio, i el document amb funcions de comprovacions
        require_once 'functions.inc.php';

        if(emptyInputLogin($usuari, $contrasenya) !== false){    //  Comprovacio camps no buids
            header("location: ../login.php?error=CampBuid");
            exit();
        }

        loginUser($conn, $usuari, $contrasenya);    // Cridem la funcio de entrar a usuari
    }
    else{                               // sino ens retorna al login
        header("location: ../login.php");
        exit();
    }

?>