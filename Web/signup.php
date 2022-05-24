<?php 
    include_once 'header.php'; /*Enllaçem al document amb el header*/
?>

    <main id="registre">
        <div class="fromulari_registre">
            <h2>Registrarse</h2>
            <form action="includes/signup.inc.php" method="post" id="signup_form">
            <?php
                if(isset($_GET["error"])){  /*Aqui en cas de que surti un cert error ens mostre un cert missatge*/
                    if($_GET["error"] == "CampBuid"){
                        echo "<p id='msg_verml'>Us falten dades per omplir!</p>";
                    }
                    else if($_GET["error"] == "UtilitzacioCaractersSpecials"){
                        echo "<p id='msg_verml'>Heu utilitzat els simbols prohibits al usuari!</p>";
                    }
                    else if($_GET["error"] == "CorreuInvalid"){
                        echo "<p id='msg_verml'>El correu es incorrecte!</p>";
                    }
                    else if($_GET["error"] == "ContrasenyaInvalid"){
                        echo "<p id='msg_verml'>La Contrasenya no consisteix!</p>";
                    }
                    else if($_GET["error"] == "Usuarijaexisteix"){
                        echo "<p id='msg_verml'>Usuari ja existeix!</p>";
                    }
                    else if($_GET["error"] == "stmtfailed"){
                        echo "<p id='msg_verml'>Alguna cosa ha fallat, torna-ho a provar</p>";
                    }
                    else if($_GET["error"] == "none"){
                        echo "<p id='msg_verd'>Ja t'has registrat!</p>";
                    }
                }
            ?>
                <label for="dni">DNI: </label>
                <input type="text" name="dni">

                <label for="nom">Nom: </label>
                <input type="text" name="nom">

                <label for="cognom">Cognom: </label>
                <input type="text" name="cognom">

                <label for="usuari">Usuari: </label>
                <input type="text" name="usuari">

                <label for="contrasenya">Contrasenya: </label>
                <input type="password" name="contrasenya">

                <label for="rep_contrasenya">Repeteix la contrasenya: </label>
                <input type="password" name="rep_contrasenya">

                <label for="sexe">Sexe: </label>
                <input type="text" name="sexe">

                <label for="email">Email: </label>
                <input type="text" name="email">
                
                <select>    <!-- al clica ens tira a una funcio de js que ensenya els camps addicionals, o els eliminara -->
                    <option onclick="removeAdd()">Escolliu una opcio si...</option>
                    <option onclick="familiaN()">Si sou de familia nombrosa</option>
                    <option onclick="federat()">Si sou federat</option>
                </select>

                <div id="familiaNombrosa" class="camp_add"> <!-- camps addicionals per faminila nombrosa -->
                    <label for="num_familia">Numero Familia Nombrosa: </label>
                    <input type="text" name="num_familia">

                    <label for="data_cad">Data caducitat: </label>
                    <input type="text" name="data_cad" placeholder="any/mes/dia">
                </div>

                <div id="federat" class="camp_add"> <!-- camps addicionals per federats -->
                    <label for="nivell_fed">Nivell: </label>
                    <input type="number" name="nivell_fed">

                    <label for="num_fed">Numero Federacio: </label>
                    <input type="text" name="num_fed">

                    <label for="data_cad_fed">Data Caducitat: </label>
                    <input type="text" name="data_cad_fed" placeholder="any/mes/dia">
                </div>

                <div id="camps_add"></div>

                <input type="submit" name="submit" class="submit_button" value="Registrar-se"/>
            </form> 
        </div>
        
    </main>

<?php /*    Enllaç al footer    */
    include_once 'footer.php';
?>