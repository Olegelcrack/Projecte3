<?php

if(isset($_POST["submit"])){    // si s'ha enviat el formulari ens fa lo seguent: 

    $dni = $_POST["dni"];   //Gravem cada dada de formulari
    $nom = $_POST["nom"];
    $cognom = $_POST["cognom"];
    $usuari = $_POST["usuari"];
    $contrasenya = $_POST["contrasenya"];
    $rep_contrasenya = $_POST["rep_contrasenya"];
    $sexe = $_POST["sexe"];
    $email = $_POST["email"];

    /*  Camp de familia nombrosa    */

    $num_familia = $_POST["num_familia"];
    $data_cad = $_POST["data_cad"];

    /*  Camp de federat     */

    $nivell_fed = $_POST["nivell_fed"];
    $num_fed = $_POST["num_fed"];
    $data_cad_fed = $_POST["data_cad_fed"];


    require_once 'Con_DB.inc.php';    // Cridem aquest per fer la connexio a bd
    require_once 'functions.inc.php'; // Cridem aquest arxiu per agafar funcions que hem definit en ell

    if(emptyInputSignup($dni, $nom, $cognom, $usuari, $contrasenya, $rep_contrasenya, $sexe, $email) !== false){    //  Crida la funcio del document functions per fer Comprovacio de camps no buids, si algo falle ens surt d'aqui i ens retorna a la pagina del registre
        header("location: ../signup.php?error=CampBuid");                                                           //  Agafem com a parametre cada variable del camp amb quin volem fer la comprovacio
        exit();
    }

    if(invalidUser($usuari) !== false){                           //  Comprovacio de caracters usuari
        header("location: ../signup.php?error=UtilitzacioCaractersSpecials");
        exit();
    }

    if(invalidEmail($email) !== false){                             // Comprovacio correu incorrecte
        header("location: ../signup.php?error=CorreuInvalid");
        exit();
    }

    if(pwdMatch($contrasenya, $rep_contrasenya) !== false){         // Comprovacio si la contrasenya coincideix
        header("location: ../signup.php?error=ContrasenyaInvalid");
        exit();
    }

    if(userExists($conn, $usuari, $email) !== false){               // Comprovacio si existeix usuari
        header("location: ../signup.php?error=Usuarijaexisteix");
        exit();
    }

    createUser($conn, $dni, $nom, $cognom, $usuari, $contrasenya, $sexe, $email, $num_familia, $data_cad, $nivell_fed, $num_fed, $data_cad_fed); //despres de fer tots comprovacions ens crida la funcio de crea usuari

}else{ //sino retorna a pagina de registre
    header("location: ../signup.php"); 
    exit();
}

?>