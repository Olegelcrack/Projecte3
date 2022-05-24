<?php 
    include_once 'header.php';
?>
        <nav id="def">
            <a href="tots_productes.php">Tots Productes</a>
            <a href="prediccio_temps.html">Predicció de temps del dia</a>
        </nav>
        <main id="cursos">                                                          <!-- Aquesta pagina tirara consultes a base de dades per revisar si tenim algun curs llogat -->
            <h2>Cursos Individuals llogats: </h2>
            <?php
            
                $sql = "SELECT C.nom AS Nom_Act, C.descripcio, C.data, lInd.hora_inici, lInd.hores, lInd.preu_final, M.nom AS Nom_Mon, M.cognom FROM curs C, lloga_curs_individual lInd, monitor M WHERE C.id=lInd.id AND M.dni=C.monitor AND lInd.dni='$_SESSION[dni]'";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result)==0){
                    echo"<p id='noact'>No heu llogat cap Curs d'aquest tipus</p>";
                }

                if(mysqli_num_rows($result) != 0){
                    $row = mysqli_fetch_assoc($result);

                    foreach($result as $row){
            
            ?>
                        <ul>
                            <hr />
                            <li><p><?= $row['Nom_Act'] ?></p> <p><?= $row['descripcio'] ?></p> <p>Data Activitat:<br/> <?= $row['data'] ?></p> <p>Hora inici:<br/> <?= $row['hora_inici'] ?></p> <p>Duració:<br/> <?= $row['hores'] ?>H</p> <p>Monitor:<br/> <?= $row['Nom_Mon'] ?> <?= $row['cognom'] ?></p> <p>Preu Final:<br/> <?= $row['preu_final'] ?>€</p></li>
                            <hr />
                        </ul>
            <?php
                    }
                }
            ?>

            <h2>Cursos Col·lectius llogats: </h2>
            <?php
            
                $sql = "SELECT C.nom AS Nom_Act, C.descripcio, C.data, lCol.preu_final, M.nom AS Nom_Mon, M.cognom FROM curs C, lloga_curs_colectiu lCol, monitor M WHERE C.id=lCol.id AND M.dni=C.monitor AND lCol.dni='$_SESSION[dni]'";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result)==0){
                    echo"<p id='noact'>No heu llogat cap Curs d'aquest tipus</p>";
                }

                if(mysqli_num_rows($result) != 0){
                    $row = mysqli_fetch_assoc($result);

                    foreach($result as $row){
            ?>

                        <ul>
                            <hr />
                            <li><p><?= $row['Nom_Act'] ?></p> <p><?= $row['descripcio'] ?></p> <p>Data Activitat:<br/> <?= $row['data'] ?></p> <p>Monitor:<br/> <?= $row['Nom_Mon'] ?> <?= $row['cognom'] ?></p> <p>Preu Final:<br/> <?= $row['preu_final'] ?></p></li>
                            <hr />
                        </ul>

            <?php
                    }
                }
            ?>

            <h2>Cursos Competicions llogats: </h2>

            <?php
            
                $sql = "SELECT C.nom AS Nom_Act, C.descripcio, C.data, M.nom AS Nom_Mon, M.cognom, COMP.nivell, COMP.data_fi FROM curs C, lloga_curs_comp lComp, monitor M, competicio COMP WHERE C.id=lComp.id_curs AND C.id=COMP.id AND M.dni=C.monitor AND lComp.dni='$_SESSION[dni]'";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result)==0){
                    echo"<p id='noact'>No heu llogar cap curs d'aquest tipus</p>";
                }

                if(mysqli_num_rows($result) != 0){
                    $row = mysqli_fetch_assoc($result);

                    foreach($result as $row){
            
            ?>
                        <ul>
                            <hr />
                            <li><p><?= $row['Nom_Act'] ?></p> <p><?= $row['descripcio'] ?></p> <p>Data Activitat:<br/> <?= $row['data'] ?></p> <p>Nivell:<br/> <?= $row['nivell'] ?></p> <p>Data Fi:<br/> <?= $row['data_fi'] ?></p> <p>Monitor:<br/> <?= $row['Nom_Mon'] ?> <?= $row['cognom'] ?></li>
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