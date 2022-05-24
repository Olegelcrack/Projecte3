<?php 
    include_once 'header.php';
?>
        <nav id="def"> 
            <a href="tots_productes.php">Tots Productes</a>
            <a href="prediccio_temps.html">Predicció de temps del dia</a>
        </nav>
        <main id="dades_usuari">        <!-- Cridem consulta per obtindre les dades d'usuari -->
            <?php
            
                $sql = "SELECT * FROM client where usuari='$_SESSION[usuari]';";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) != 0){
                    $row = mysqli_fetch_assoc($result);

                    foreach($result as $row){
            ?>

                    <ul>
                        <hr />
                        <li>DNI: <?= $row['dni'] ?></li>
                        <hr />
                        <li>Nom: <?= $row['nom'] ?></li>
                        <hr />
                        <li>Cognom: <?= $row['cognom'] ?></li>
                        <hr />
                        <li>Sexe: 
                            <?php 
                                if($row['sexe'] == 'H'){echo "Home";}       /*si la dada que ens retorna es H, escriu home, si es D, dona*/
                                elseif($row['sexe'] == 'D'){echo "Dona";}
                            ?>
                        </li>
                        <hr />
                        <li>Correu electronic: <?= $row['email'] ?></li>
                        <hr />
                    </ul>

            <?php
                    }
                }
            
            ?>
        </main>
<?php
    include_once 'footer.php';
?>