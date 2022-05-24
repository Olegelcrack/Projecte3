<?php 
    include_once 'header.php';
?>
        <nav id="def">
            <a href="tots_productes.php">Tots Productes</a>
            <a href="prediccio_temps.html">Predicció de temps del dia</a>
        </nav>
        <main id="material">        <!-- Aqui cridem una consulta per obtindre el material que ha llogat el client -->
            <h2>Material llogat: </h2>
            <?php
            
                $sql = "SELECT LP.data, LP.preu, P.nom, P.marca FROM lloga_prod LP, producte P WHERE P.id=LP.id_prod AND LP.dni='$_SESSION[dni]'";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result)==0){
                    echo"<p id='noact'>No heu llogat res de Material</p>";  // si no retorna cap linia, ens donara un avis
                }

                if(mysqli_num_rows($result) != 0){
                    $row = mysqli_fetch_assoc($result);

                    foreach($result as $row){
            
            ?>

                        <ul>
                            <hr />
                            <li>Producte: <p><?= $row['nom'] ?></p> <p><?= $row['marca'] ?></p> <p><?= $row['preu'] ?>€</p> <p>Data Compra: <?= $row['data'] ?></p></li>
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