<?php 
    include_once 'header.php'; // enllacem el header de la pagina
?>

    <main id="login">
        <div class="fromulari_registre">
            <h2>Inicia Secció</h2>
            <br />
            <form action="includes/login.inc.php" method="post">
            <?php
                if(isset($_GET["error"])){      // Si tenim un error ens sortira un missatge
                    if($_GET["error"] == "CampBuid"){
                        echo "<p id='msg_verml'>Us falten dades per omplir!</p>";
                    }
                    else if($_GET["error"] == "dadesincorrectes"){
                        echo "<p id='msg_verml'>Usuari o Contrasenya incorrecte!</p>";
                    }
                }
            ?>
                <label for="usuari">Usuari o Correu electronic: </label>
                <input type="text" name="usuari">

                <label for="contrasenya">Contrasenya: </label>
                <input type="password" name="contrasenya">

                <input type="submit" name="inicia-sessio" class="submit_button" value="Inicia Sessió"/>

            </form>
            <p>Si no teniu cap compte creat, <a href="signup.php">Registreu-vos</a></p>
        </div>
        
    </main>

<?php 
    include_once 'footer.php'; // enllacem el footer de la pagina
?>