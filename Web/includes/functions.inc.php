<?php

function emptyInputSignup($dni, $nom, $cognom, $usuari, $contrasenya, $rep_contrasenya, $sexe, $email){     //  Funcio que fa la comprovacio de si els camps estan buids
    $result;
    if(empty($dni) || empty($nom) || empty($cognom) || empty($usuari) || empty($contrasenya) || empty($rep_contrasenya) || empty($sexe) || empty($email)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidUser($usuari){      //  Funcio que comprova els caracters del camp usuari
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $usuari)){ //  Si el caracter es un dels prohibits ens retorna true
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){      //  Funcio que comprova que el correu sigui valid 
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ // Cridem una funcio de php per validar el EMail
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($contrasenya, $rep_contrasenya){  // Comprovem si la contrasenya coincideix
    $result;
    if($contrasenya !== $rep_contrasenya){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function userExists($conn, $usuari, $email){        // Comprovem si l'usari existeix
    $sql = "SELECT * FROM client WHERE usuari = ? OR email = ?;"; //tirem consulta per llista usuaris
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){      // Si la connexio falla ens retorna amb error al registre
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $usuari, $email);   // Estem agafant les dades de base de dades, indiquem la variable del statement, despres en "" posem tipus i quantitat de dades que volem obtindre, "ss"(string, string), i al $usuari i $email asignem com a variables les dades que obtenim 
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $dni, $nom, $cognom, $usuari, $contrasenya, $sexe, $email, $num_familia, $data_cad, $nivell_fed, $num_fed, $data_cad_fed){ // Funcio per crear un usuari
    $sql = "INSERT INTO client (dni, nom, cognom, usuari, contrasenya, sexe, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){ //per si falla la connexio
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    $hashedContrasenya = password_hash($contrasenya, PASSWORD_DEFAULT);     // defensa de hackers, xifrem la contrasenya

    mysqli_stmt_bind_param($stmt, "sssssss", $dni, $nom, $cognom, $usuari, $hashedContrasenya, $sexe, $email);   // introduim cada dada com a string posant les variables de cada un
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($num_familia!=null & $data_cad!=null){ // si detecta algo a dins de variables de camps addicionals, ens fa un altre insert a familiar

        $stmt1 = mysqli_stmt_init($conn);
        $sql1 = "INSERT INTO familia_nombrosa VALUES (?, ?, ?)";

        if(!mysqli_stmt_prepare($stmt1, $sql1)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "sss", $dni, $num_familia, $data_cad);   
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);
    }

    if($nivell_fed!=null & $num_fed!=null & $data_cad_fed!=null){ // si detecta algo a dins de variables de camps de federat, ens fa un altre insert a federat

        $stmt2 = mysqli_stmt_init($conn);
        $sql2 = "INSERT INTO federat VALUES (?, ?, ?, ?)";

        if(!mysqli_stmt_prepare($stmt2, $sql2)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt2, "ssss", $dni, $nivell_fed, $num_fed, $data_cad_fed);   
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }

    header("location: ../signup.php?error=none"); // error=none sera l'avis de que tot ha anat be
    exit();
}

function emptyInputLogin($usuari, $contrasenya){     //  Funcio que fa la comprovacio de si els camps de login estan buids
    $result;
    if(empty($usuari) || empty($contrasenya)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $usuari, $contrasenya){ // funcio per iniciar la sessio
    $userExists = userExists($conn, $usuari, $usuari); // agafem les dades per comprovar si existeix

    if($userExists === false){      // si no existeix retorna error de dades incorrectes
        header("location: ../login.php?error=dadesincorrectes");
        exit();
    }

    $contrasenyaHashed = $userExists["contrasenya"]; //agafem la contrasenya
    $checkContrasenya = password_verify($contrasenya, $contrasenyaHashed); // verifiquem amb la que l'usuari ha ficat al camp

    if($checkContrasenya === false){    // si falla ens retorna a login amb un error
        header("location: ../login.php?error=dadesincorrectes");
        exit();
    }
    else if($checkContrasenya === true){    // si no falla ens iniciara la sessio, i grabara les dades de sessio que indiquem
        session_start();
        $_SESSION["dni"] = $userExists["dni"];
        $_SESSION["usuari"] = $userExists["usuari"];
        $_SESSION["nom"] = $userExists["nom"];
        $_SESSION["cognom"] = $userExists["cognom"];

        header("location: ../index.php"); // ens enviara a la pagina inicial
        exit();
    }
}

?>